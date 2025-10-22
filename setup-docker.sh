#!/bin/bash

echo "=== Yii2 MicroApp Docker Setup ==="

# Kiểm tra file app.env
if [ ! -f "./yii2-app/app.env" ]; then
    echo "❌ File app.env not found!"
    exit 1
fi

# Kiểm tra Docker
if ! command -v docker &> /dev/null; then
    echo "❌ Docker not found. Please install Docker first."
    exit 1
fi

if ! command -v docker-compose &> /dev/null; then
    echo "❌ Docker Compose not found. Please install Docker Compose first."
    exit 1
fi

echo "✅ Docker and Docker Compose found"

# Dừng containers hiện tại
echo "🛑 Stopping existing containers..."
docker-compose down

# Build và khởi động
echo "🔨 Building and starting containers..."
docker-compose up --build -d

# Đợi services khởi động
echo "⏳ Waiting for services to start..."
sleep 30

# Kiểm tra trạng thái
echo "📊 Checking container status..."
docker-compose ps

# Chạy migrations
echo "🗄️ Running database migrations..."
docker-compose exec yii2-app php /var/www/html/yii2-app/yii migrate --interactive=0

# Cài đặt Composer dependencies
echo "📦 Installing Composer dependencies..."
docker-compose exec yii2-app composer install --no-dev --optimize-autoloader

# Cấu hình quyền
echo "🔐 Setting file permissions..."
docker-compose exec yii2-app chown -R www-data:www-data /var/www/html/yii2-app/runtime
docker-compose exec yii2-app chown -R www-data:www-data /var/www/html/yii2-app/web/assets
docker-compose exec yii2-app chmod -R 755 /var/www/html/yii2-app/runtime
docker-compose exec yii2-app chmod -R 755 /var/www/html/yii2-app/web/assets

# Test environment
echo "🧪 Testing environment configuration..."
docker-compose exec yii2-app php -r "
echo 'App Name: ' . getenv('APP_NAME') . PHP_EOL;
echo 'DB Host: ' . getenv('DB_HOST') . PHP_EOL;
echo 'DB Name: ' . getenv('DB_NAME') . PHP_EOL;
echo 'Mailer From: ' . getenv('MAILER_FROM_ADDRESS') . PHP_EOL;
echo 'Docker Env: ' . (getenv('DOCKER_ENV') ? 'true' : 'false') . PHP_EOL;
"

echo ""
echo "🎉 === Setup Complete ==="
echo "🌐 Web Application: http://localhost:8080"
echo "🗄️ MySQL: localhost:3306"
echo "📊 Database: $(grep DB_NAME ./yii2-app/app.env | cut -d'=' -f2)"
echo "👤 User: $(grep DB_USERNAME ./yii2-app/app.env | cut -d'=' -f2)"
echo "🔑 Password: $(grep DB_PASSWORD ./yii2-app/app.env | cut -d'=' -f2)"
echo ""
echo "📧 Email Settings:"
echo "   Transport: $(grep MAILER_TRANSPORT ./yii2-app/app.env | cut -d'=' -f2)"
echo "   From: $(grep MAILER_FROM_ADDRESS ./yii2-app/app.env | cut -d'=' -f2)"
echo "   From Name: $(grep MAILER_FROM_NAME ./yii2-app/app.env | cut -d'=' -f2)"
echo ""
echo "📋 === Useful Commands ==="
echo "📄 View logs: docker-compose logs -f"
echo "🔧 Open shell: docker-compose exec yii2-app bash"
echo "🗄️ Run migrations: docker-compose exec yii2-app php /var/www/html/yii2-app/yii migrate"
echo "🧪 Test API: curl http://localhost:8080"
