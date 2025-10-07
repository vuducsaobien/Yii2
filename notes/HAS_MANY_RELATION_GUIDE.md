# Yii2 hasMany() Relation Implementation Guide

## Tổng quan
Dự án này thể hiện cách sử dụng method `hasMany()` trong Yii2 Active Record để tạo các mối quan hệ one-to-many (1-n).

## Cấu trúc Database
```
Customer (1) -> (N) Order
```
- Mỗi Customer có thể có nhiều Orders

## Models và Relations

### 1. Customer Model (`models/Customer.php`)
```php
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['customer_id' => 'id']);
    }
```
## Migration

### Order Table
    ```php
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer()->notNull()->comment('Foreign key to customer table'),
        ]);
    ```

## API Endpoints

## Cách hoạt động của hasMany()

### 1. Relationship Pattern
```php
// Customer has many Orders
Customer -> Orders (1:n)
```

### 2. SQL Queries được tạo
```sql
-- Query 1: Lấy customers
SELECT * FROM `customer`

-- Query 2: Lấy orders thông qua customer_id
SELECT * FROM `order` WHERE `customer_id` IN (1, 2, 3, ...)
(Tất cả Customer hiện có trong table Customer)
```

### 3. Query Optimization
- Sử dụng `with(['orders'])` để eager loading
- Tránh N+1 query problem
- Chỉ thực hiện 2 queries thay vì N+1 queries

## Ví dụ sử dụng

### 1. Lấy Customer với Orders
```php
$customer = Customer::find()->with(['orders'])->one();

echo "Customer: {$customer->name}";
foreach ($customer->orders as $order) {
    echo "Order: {$order->order_number} - {$order->total_amount}";
}
```

### 2. Lấy tất cả Customers với Orders
```php
$customers = Customer::find()->with(['orders'])->all();

foreach ($customers as $customer) {
    echo "Customer: {$customer->name}";
    foreach ($customer->orders as $order) {
        echo "  Order: {$order->order_number}";
    }
}
```

## Lợi ích của hasMany()

1. **Performance**: Chỉ cần 2 queries thay vì N+1 queries
2. **Code Clean**: Không cần viết JOIN phức tạp
3. **Maintainable**: Dễ dàng thay đổi relationship logic
4. **Type Safety**: IDE có thể autocomplete properties
5. **Lazy Loading**: Chỉ load khi cần thiết


## Kết luận

Method `hasMany()` trong Yii2 cho phép tạo các mối quan hệ one-to-many một cách elegant và hiệu quả, đặc biệt hữu ích khi làm việc với foreign key relationships trong các hệ thống phức tạp.

### Key Points:
- **hasMany()**: Tạo relationship 1:n (hasMany)
- **hasOne()**: Tạo relationship 1:1 (belongsTo)
- **via()**: Tạo relationship qua junction table
- **with()**: Eager loading để tối ưu performance