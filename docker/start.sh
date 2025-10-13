#!/bin/bash

echo "=== Khởi động Yii2 Learning Environment ==="

# Tạo thư mục cần thiết
mkdir -p /var/run/mysqld
chown mysql:mysql /var/run/mysqld
chmod 755 /var/run/mysqld

# Cấu hình MySQL trước khi khởi động
echo "Cấu hình MySQL..."
sed -i 's/bind-address.*=.*127.0.0.1/bind-address = 0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf

# Khởi động MySQL và đợi sẵn sàng
echo "Khởi động MySQL..."
service mysql start

# Đợi MySQL sẵn sàng (tối đa 30 giây)
echo "Đợi MySQL sẵn sàng..."
for i in {1..30}; do
    if mysqladmin ping -h localhost -u root -p$MYSQL_ROOT_PASSWORD --silent; then
        echo "MySQL đã sẵn sàng sau $i giây"
        break
    fi
    if [ $i -eq 30 ]; then
        echo "MySQL không sẵn sàng sau 30 giây"
        exit 1
    fi
    sleep 1
done

# Khởi tạo database và user (chỉ 1 lần)
echo "Khởi tạo database và user..."
mysql -u root -p$MYSQL_ROOT_PASSWORD << EOF
CREATE DATABASE IF NOT EXISTS $MYSQL_DATABASE CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '$MYSQL_USER'@'localhost' IDENTIFIED BY '$MYSQL_PASSWORD';
CREATE USER IF NOT EXISTS '$MYSQL_USER'@'%' IDENTIFIED BY '$MYSQL_PASSWORD';
GRANT ALL PRIVILEGES ON $MYSQL_DATABASE.* TO '$MYSQL_USER'@'localhost';
GRANT ALL PRIVILEGES ON $MYSQL_DATABASE.* TO '$MYSQL_USER'@'%';
ALTER USER '$MYSQL_USER'@'%' IDENTIFIED WITH mysql_native_password BY '$MYSQL_PASSWORD';
ALTER USER '$MYSQL_USER'@'localhost' IDENTIFIED WITH mysql_native_password BY '$MYSQL_PASSWORD';
FLUSH PRIVILEGES;
EOF

echo "Database setup hoàn tất"

# Khởi động PHP-FPM
echo "Khởi động PHP-FPM..."
service php8.1-fpm start

# Khởi động Nginx
echo "Khởi động Nginx..."
service nginx start

echo "=== Services đã khởi động thành công ==="
echo "Web: http://localhost:8080"
echo "MySQL: localhost:3306"
echo "Database: $MYSQL_DATABASE"
echo "User: $MYSQL_USER"
echo "Password: $MYSQL_PASSWORD"

# Giữ container chạy
tail -f /dev/null
