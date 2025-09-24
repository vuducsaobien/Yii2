#!/bin/bash

echo "=== Khởi động Yii2 Learning Environment ==="

# Tạo thư mục cần thiết
mkdir -p /var/run/mysqld
chown mysql:mysql /var/run/mysqld
chmod 755 /var/run/mysqld

# Khởi động MySQL
service mysql start
sleep 5

# Sửa MySQL bind address
sed -i 's/bind-address.*=.*127.0.0.1/bind-address = 0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf
service mysql restart
sleep 3

# Khởi tạo database và user
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "CREATE DATABASE IF NOT EXISTS $MYSQL_DATABASE CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>/dev/null || true
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "CREATE USER IF NOT EXISTS '$MYSQL_USER'@'localhost' IDENTIFIED BY '$MYSQL_PASSWORD';" 2>/dev/null || true
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "CREATE USER IF NOT EXISTS '$MYSQL_USER'@'%' IDENTIFIED BY '$MYSQL_PASSWORD';" 2>/dev/null || true
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "GRANT ALL PRIVILEGES ON $MYSQL_DATABASE.* TO '$MYSQL_USER'@'localhost';" 2>/dev/null || true
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "GRANT ALL PRIVILEGES ON $MYSQL_DATABASE.* TO '$MYSQL_USER'@'%';" 2>/dev/null || true
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "ALTER USER '$MYSQL_USER'@'%' IDENTIFIED WITH mysql_native_password BY '$MYSQL_PASSWORD';" 2>/dev/null || true
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "ALTER USER '$MYSQL_USER'@'localhost' IDENTIFIED WITH mysql_native_password BY '$MYSQL_PASSWORD';" 2>/dev/null || true
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "FLUSH PRIVILEGES;" 2>/dev/null || true

# Khởi động PHP-FPM
service php8.1-fpm start

# Khởi động Nginx
service nginx start

echo "=== Services đang khởi động ==="
echo "Web: http://localhost:8080"
echo "MySQL: localhost:3306"
echo "Database: $MYSQL_DATABASE"
echo "User: $MYSQL_USER"
echo "Password: $MYSQL_PASSWORD"

# Giữ container chạy
tail -f /dev/null
