# Yii2 MicroApp Docker Environment Setup

## Tổng quan

Hệ thống Yii2 MicroApp với Docker sử dụng file `app.env` để cấu hình tất cả các thành phần.

Trong Yii2, package vlucas/phpdotenv (tác giả là Vance Lucas) dùng để quản lý và nạp các biến môi trường (environment variables) từ file .env vào ứng dụng PHP.

## Environment Configuration

### File `app.env`

File chính chứa tất cả cấu hình:

## Quick Start

### 1. Test Environment

```bash
# Test environment configuration
./test-env.sh
```

### 2. Setup Docker

```bash
# Full setup
./setup-docker.sh

# Or using Makefile
make setup
```

### 3. Test Application

```bash
# Test API
curl http://localhost:8080

# Or using Makefile
make test
```

## Commands

### Docker Management

```bash
make up          # Start services
make down         # Stop services
make restart      # Restart services
make logs         # View logs
make shell        # Open shell
make clean        # Clean up
```

### Database

```bash
make migrate      # Run migrations
```

### Testing

```bash
make test         # Test environment and API
./test-env.sh     # Test environment only
```

## Configuration Files

### Database (`config/db.php`)

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => env('DB_DRIVER', 'mysql') . ':host=' . env('DB_HOST', 'localhost') . ';port=' . env_int('DB_PORT', 3306) . ';dbname=' . env('DB_NAME', 'yii2db'),
    'username' => env('DB_USERNAME', 'yii2user'),
    'password' => env('DB_PASSWORD', 'yii2pass'),
    'charset' => env('DB_CHARSET', 'utf8mb4'),
    'enableSchemaCache' => is_production(),
];
```

### Mailer (`config/web.php`)

```php
'mailer' => [
    'class' => \yii\symfonymailer\Mailer::class,
    'useFileTransport' => env('MAILER_TRANSPORT', 'file') === 'file',
    'transport' => [
        'host' => env('MAILER_HOST'),
        'port' => env_int('MAILER_PORT', 587),
        'username' => env('MAILER_USERNAME'),
        'password' => env('MAILER_PASSWORD'),
    ],
],
```

## Environment Variables

### Required Variables

- `YII_ENV` - Environment (dev/prod/test)
- `YII_DEBUG` - Debug mode (0/1)
- `APP_NAME` - Application name
- `DB_HOST` - Database host
- `DB_NAME` - Database name
- `DB_USERNAME` - Database username
- `DB_PASSWORD` - Database password

### Optional Variables

- `MAILER_TRANSPORT` - Email transport (file/smtp)
- `MAILER_HOST` - SMTP host
- `MAILER_PORT` - SMTP port
- `MAILER_USERNAME` - SMTP username
- `MAILER_PASSWORD` - SMTP password

## Docker Integration

### docker-compose.yml

```yaml
services:
  yii2-app:
    build: .
    env_file:
      - ./yii2-app/app.env
    environment:
      - DB_HOST=localhost
      - DOCKER_ENV=1
```

### Environment Override

Docker có thể override environment variables:

```yaml
environment:
  - DB_HOST=mysql-container
  - MAILER_TRANSPORT=smtp
  - MAILER_HOST=smtp.gmail.com
```

## Helper Functions

### Environment Helpers

```php
env($key, $default)           // Get environment variable
env_bool($key, $default)      // Get boolean value
env_int($key, $default)       // Get integer value
is_docker()                   // Check if running in Docker
is_production()               // Check if production environment
is_development()              // Check if development environment
```

## URLs

- **Web Application**: http://localhost:8080
- **MySQL**: localhost:3306

## Troubleshooting

### Common Issues

1. **Environment not loaded**
   ```bash
   # Check app.env file
   ls -la yii2-app/app.env
   
   # Test environment
   ./test-env.sh
   ```

2. **Database connection failed**
   ```bash
   # Check database variables
   grep DB_ yii2-app/app.env
   
   # Test connection
   make migrate
   ```

3. **Docker container not running**
   ```bash
   # Check container status
   docker-compose ps
   
   # Start containers
   make up
   ```

### Debug Commands

```bash
# Test environment
./test-env.sh

# Check Docker logs
make logs

# Open shell in container
make shell

# Test API
curl http://localhost:8080
```

## Best Practices

1. **Environment Files**
   - Keep `app.env` as main configuration
   - Use environment-specific overrides
   - Never commit sensitive data

2. **Configuration**
   - Use helper functions for type safety
   - Set sensible defaults
   - Validate required variables

3. **Docker**
   - Use environment files
   - Override for container-specific settings
   - Test configuration before deployment

4. **Security**
   - Use strong passwords
   - Don't expose sensitive data
   - Use environment-specific configurations
