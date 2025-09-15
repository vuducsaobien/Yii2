FROM ubuntu:22.04

# Cài đặt biến môi trường
ENV DEBIAN_FRONTEND=noninteractive
ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_DATABASE=yii2db
ENV MYSQL_USER=yii2user
ENV MYSQL_PASSWORD=yii2pass

# Cài đặt dependencies
RUN apt-get update && apt-get install -y \
    software-properties-common \
    curl \
    wget \
    git \
    supervisor \
    && rm -rf /var/lib/apt/lists/*

# Cài đặt PHP 8.1
RUN add-apt-repository ppa:ondrej/php -y && \
    apt-get update && apt-get install -y \
    php8.1 \
    php8.1-cli \
    php8.1-fpm \
    php8.1-mysql \
    php8.1-zip \
    php8.1-gd \
    php8.1-mbstring \
    php8.1-curl \
    php8.1-xml \
    php8.1-bcmath \
    && rm -rf /var/lib/apt/lists/*

# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Cài đặt MySQL 8.0 và Nginx
RUN apt-get update && apt-get install -y \
    mysql-server-8.0 \
    nginx \
    && rm -rf /var/lib/apt/lists/*

# Tạo thư mục làm việc
WORKDIR /var/www/html

# Copy các file cấu hình
COPY docker/nginx.conf /etc/nginx/sites-available/default
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/mysql.cnf /etc/mysql/mysql.conf.d/mysql.cnf
COPY docker/start.sh /start.sh

# Cấu hình quyền
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Cấu hình MySQL
RUN mkdir -p /var/lib/mysql-files && \
    chown mysql:mysql /var/lib/mysql-files && \
    chmod 750 /var/lib/mysql-files

# Cấu hình Nginx
RUN ln -sf /dev/stdout /var/log/nginx/access.log && \
    ln -sf /dev/stderr /var/log/nginx/error.log

# Cấu hình PHP-FPM
RUN sed -i 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/' /etc/php/8.1/fpm/php.ini && \
    sed -i 's/listen = \/run\/php\/php8.1-fpm.sock/listen = 127.0.0.1:9000/' /etc/php/8.1/fpm/pool.d/www.conf

# Expose ports
EXPOSE 80 3306

# Tạo script khởi động
RUN chmod +x /start.sh

# Khởi động
CMD ["/start.sh"]
