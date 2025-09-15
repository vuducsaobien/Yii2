#!/bin/bash

echo "=== Khởi động Yii2 Learning Environment ==="

# Khởi động MySQL
service mysql start
sleep 3

# Khởi tạo database
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "CREATE DATABASE IF NOT EXISTS $MYSQL_DATABASE CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>/dev/null || true
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "CREATE USER IF NOT EXISTS '$MYSQL_USER'@'localhost' IDENTIFIED BY '$MYSQL_PASSWORD';" 2>/dev/null || true
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "GRANT ALL PRIVILEGES ON $MYSQL_DATABASE.* TO '$MYSQL_USER'@'localhost';" 2>/dev/null || true
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "FLUSH PRIVILEGES;" 2>/dev/null || true

# Tạo Yii2 project nếu chưa có
if [ ! -d "/var/www/html/yii2-app/vendor" ]; then
    echo "Tạo Yii2 project lần đầu..."
    cd /var/www/html
    composer create-project --prefer-dist yiisoft/yii2-app-basic yii2-app
    
    # Cấu hình database
    cd yii2-app
    cat > config/db.php << EOL
<?php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=$MYSQL_DATABASE',
    'username' => '$MYSQL_USER',
    'password' => '$MYSQL_PASSWORD',
    'charset' => 'utf8mb4',
];
EOL
    
    chown -R www-data:www-data /var/www/html/yii2-app
    chmod -R 755 /var/www/html/yii2-app
    echo "Yii2 project đã được tạo!"
else
    echo "Yii2 project đã tồn tại."
fi

echo "=== Services đang khởi động ==="
echo "Web: http://localhost:8080"
echo "MySQL: localhost:3306"
echo "Database: $MYSQL_DATABASE"
echo "User: $MYSQL_USER"
echo "Password: $MYSQL_PASSWORD"

# Khởi động supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
