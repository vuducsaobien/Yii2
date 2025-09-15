# Yii2 Learning Environment với Docker

Setup đơn giản để học Yii2 Framework với PHP 8.1 và MySQL 8.0.

## Cách sử dụng

### 1. Khởi động
```bash
docker-compose up --build
```

### 2. Truy cập
- **Website**: http://localhost:8080
- **MySQL**: localhost:3306

### 3. Thông tin Database
- **Database**: yii2db
- **Username**: yii2user  
- **Password**: yii2pass
- **Root Password**: root

## Các lệnh hữu ích

### Quản lý Container
```bash
# Dừng
docker-compose down

# Vào container
docker exec -it yii2-learning bash

# Xem logs
docker-compose logs -f
```

### Làm việc với Yii2
```bash
# Vào container
docker exec -it yii2-learning bash

# Chạy migrations
cd /var/www/html/yii2-app
php yii migrate

# Tạo model
php yii gii/model --tableName=users

# Tạo CRUD
php yii gii/crud --modelClass=app\\models\\User
```

### Kết nối Database
```bash
# Từ bên ngoài
mysql -h localhost -P 3306 -u yii2user -p yii2db

# Từ bên trong container
docker exec -it yii2-learning mysql -u yii2user -p yii2db
```

## Lưu ý
- Lần đầu chạy sẽ tự động tạo Yii2 project
- Dữ liệu MySQL được lưu trong Docker volume
- Code Yii2 được mount vào thư mục `./yii2-app`
