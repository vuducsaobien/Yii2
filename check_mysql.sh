#!/bin/bash

# Script kiểm tra MySQL ready và kết nối DBeaver
# Sử dụng: ./check_mysql.sh

echo "🔍 Kiểm tra trạng thái MySQL Container..."

# Kiểm tra container đang chạy
if ! docker ps | grep -q "yii2-learning"; then
    echo "❌ Container yii2-learning không chạy!"
    echo "💡 Chạy: docker-compose up -d"
    exit 1
fi

echo "✅ Container đang chạy"

# Kiểm tra health status
echo "🏥 Checking health status..."
health_status=$(docker inspect --format='{{.State.Health.Status}}' yii2-learning 2>/dev/null || echo "no-healthcheck")

if [ "$health_status" = "healthy" ]; then
    echo "✅ Container healthy"
elif [ "$health_status" = "starting" ]; then
    echo "⏳ Container đang khởi động..."
    echo "🔄 Đợi MySQL sẵn sàng (tối đa 60 giây)..."
    
    for i in {1..60}; do
        if docker exec yii2-learning mysqladmin ping -h localhost -u root -proot --silent 2>/dev/null; then
            echo "✅ MySQL sẵn sàng sau $i giây!"
            break
        fi
        if [ $i -eq 60 ]; then
            echo "❌ MySQL không sẵn sàng sau 60 giây"
            echo "📋 Logs:"
            docker logs yii2-learning --tail 10
            exit 1
        fi
        printf "."
        sleep 1
    done
else
    echo "⚠️  Health status: $health_status"
fi

# Test kết nối MySQL
echo "🔌 Test kết nối MySQL..."
if mysql -h 127.0.0.1 -P 3306 -u yii2user -pyii2pass -e "SELECT 'Connection OK' as status;" 2>/dev/null; then
    echo "✅ Kết nối MySQL thành công!"
    echo ""
    echo "🎯 Thông tin kết nối DBeaver:"
    echo "   Host: 127.0.0.1"
    echo "   Port: 3306"
    echo "   Database: yii2db"
    echo "   Username: yii2user"
    echo "   Password: yii2pass"
    echo ""
    echo "📊 Database info:"
    mysql -h 127.0.0.1 -P 3306 -u yii2user -pyii2pass -e "
    SELECT VERSION() as MySQL_Version;
    SHOW DATABASES;
    USE yii2db; SHOW TABLES;"
else
    echo "❌ Không thể kết nối MySQL!"
    echo "🔧 Thử khắc phục:"
    echo "   1. docker-compose restart"
    echo "   2. Đợi 30 giây"
    echo "   3. Chạy lại script này"
fi
