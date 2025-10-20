# Yii2 hasOne() Relation Implementation Guide

## Tổng quan
Dự án này thể hiện cách sử dụng method `hasOne()` trong Yii2 Active Record để tạo các mối quan hệ one-to-one (1-1).

## Cấu trúc Database
```
Customer (1) -> (1) Country
```
- Mỗi Customer thuộc về một Country
- Mỗi Country có thể có nhiều Customer

## Models và Relations

### 1. Customer Model (`models/Customer.php`)
```php
    public function getCountry()
    {
        return $this->hasOne(Country::class, ['id' => 'country_id']);
    }
```

## Migration

### Customer Table
```php
$this->createTable('{{%customer}}', [
    'id' => $this->primaryKey(),
    'country_id' => $this->integer()->notNull()->comment('Foreign key to country table'),
]);
```
## API Endpoints

### 1. `/customer/index`
- **Method**: GET
- **Description**: Lấy tất cả customers với country information
- **Response**: Customers với country data được eager load

## Cách hoạt động của hasOne()

### 1. Relationship Pattern
```php
// Customer belongs to one Country
Customer -> Country (1:1)
```

### 2. SQL Queries được tạo
```sql
-- Query 1: Lấy customers
SELECT * FROM `customer`

-- Query 2: Lấy countries thông qua country_id
SELECT * FROM `country` WHERE `id` IN (1, 2, 3, ...)
```

### 3. Query Optimization
- Sử dụng `with(['country'])` để eager loading
- Tránh N+1 query problem
- Chỉ thực hiện 2 queries thay vì N+1 queries

## Ví dụ sử dụng

### 1. Lấy Customer với Country
```php
$customer = Customer::find()->with(['country'])->one();

echo "Customer: {$customer->name}";
echo "Country: {$customer->country->name}";
```

### 2. Lấy tất cả Customers với Country
```php
$customers = Customer::find()->with(['country'])->all();

foreach ($customers as $customer) {
    echo "{$customer->name} from {$customer->country->name}";
}
```

## Lợi ích của hasOne()

1. **Performance**: Chỉ cần 2 queries thay vì N+1 queries
2. **Code Clean**: Không cần viết JOIN phức tạp
3. **Maintainable**: Dễ dàng thay đổi relationship logic
4. **Type Safety**: IDE có thể autocomplete properties
5. **Lazy Loading**: Chỉ load khi cần thiết

## Kết luận

Method `hasOne()` trong Yii2 cho phép tạo các mối quan hệ one-to-one một cách elegant và hiệu quả, đặc biệt hữu ích khi làm việc với foreign key relationships trong các hệ thống phức tạp.

### Key Points:
- **hasOne()**: Tạo relationship 1:1 (belongsTo)
- **hasMany()**: Tạo relationship 1:n (hasMany) 
- **via()**: Tạo relationship qua junction table
- **with()**: Eager loading để tối ưu performance