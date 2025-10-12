# Yii2 via() Relation Implementation Guide

## Tổng quan
Dự án này thể hiện cách sử dụng method `via()` trong Yii2 Active Record để tạo các mối quan hệ many-to-many thông qua bảng trung gian (junction table).

## Cấu trúc Database
```
Customer (1) -> (n) Order (1) -> (n) OrderItem (n) -> (1) Item
```

## Models và Relations


### 1. Customer Model (`models/Customer.php`)
    ```php
    // Direct relationship to Order
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['customer_id' => 'id']);
    }

    // via() relationship to OrderItem through Order
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id'])->via('orders');
    }

    // via() relationship to Item through OrderItem
    public function getItems()
    {
        return $this->hasMany(Item::class, ['id' => 'item_id'])->via('orderItems');
    }
    ```

### 2. Order Model (`models/Order.php`)
    ```php
    // Direct relationship to OrderItem
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
    }

    // via() relationship to Item through OrderItem
    public function getItems()
    {
        return $this->hasMany(Item::class, ['id' => 'item_id'])->via('orderItems');
    }
    ```

### 3. Item Model (`models/base/Item.php`)
    ```php
    // Direct relationship to OrderItem
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['item_id' => 'id']);
    }

    // via() relationship to Order through OrderItem
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['id' => 'order_id'])->via('orderItems');
    }
    ```

### 4. Order Item Model (`models/base/OrderItem.php`)
    ```php
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    public function getItem()
    {
        return $this->hasOne(Item::class, ['id' => 'item_id']);
    }
    ```
## Migration

### Customer Table
    ```php
        $this->createTable('{{%customer}}', [
            'id' => $this->primaryKey(),
        ]);

        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer()->notNull()->comment('Foreign key to customer table'),
        ]);

        $this->createTable('{{%order_items}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull()->comment('Foreign key to order table'),
            'item_id' => $this->integer()->notNull()->comment('Foreign key to item table'),
        ]);

        $this->createTable('{{%items}}', [
            'id' => $this->primaryKey(),
        ]);
    ```

## API Endpoints

### 1. `/customer/via-relation`
- **Method**: GET
- **Description**: Lấy tất cả orders với items sử dụng via() relation
- **Response**: Orders với items được lấy thông qua OrderItem junction table

### 2. `/customer/customer-items-via-relation`
- **Method**: GET
- **Description**: Lấy tất cả customers với items sử dụng via() relation
- **Response**: Customers với items được lấy thông qua Order -> OrderItem chain

## Cách hoạt động của via()

### 1. Junction Table Pattern
```php
// Thay vì tạo direct relationship:
Order -> Item (không thể vì cần OrderItem làm trung gian)

// Sử dụng via():
Order -> OrderItem (direct)
Order -> Item (via OrderItem)
```

### 2. SQL Queries được tạo
```sql
-- Query 1: Lấy orders
SELECT * FROM `order`

-- Query 2: Lấy order_items thông qua order_id
SELECT * FROM `order_items` WHERE `order_id` IN (1, 2, 3, ...)

-- Query 3: Lấy items thông qua item_id từ order_items
SELECT * FROM `items` WHERE `id` IN (item_ids from order_items)
```

### 3. Query Optimization
- Sử dụng `with(['items'])` để eager loading
- Tránh N+1 query problem
- Chỉ thực hiện 3 queries thay vì multiple queries per record

## Ví dụ sử dụng

### 1. Lấy Order với Items
```php
$order = Order::find()
    ->with(['items'])
    ->one();

foreach ($order->items as $item) {
    echo $item->name;
}
```

### 2. Lấy Customer với Items
```php
$customer = Customer::find()
    ->with(['items'])
    ->one();

foreach ($customer->items as $item) {
    echo $item->name;
}
```

### 3. Lấy Item với Orders
```php
$item = Item::find()
    ->with(['orders'])
    ->one();

foreach ($item->orders as $order) {
    echo $order->order_number;
}
```

## Lợi ích của via()

1. **Tối ưu Performance**: Chỉ cần 3 queries thay vì N+1 queries
2. **Code Clean**: Không cần viết JOIN phức tạp
3. **Maintainable**: Dễ dàng thay đổi relationship logic
4. **Flexible**: Có thể tạo chain relationships dài

## Testing

Để test các endpoints:
```bash
# Test via relation cho orders
curl http://localhost/customer/via-relation

# Test via relation cho customers
curl http://localhost/customer/customer-items-via-relation
```

## Kết luận

Method `via()` trong Yii2 cho phép tạo các mối quan hệ many-to-many một cách elegant và hiệu quả, đặc biệt hữu ích khi làm việc với junction tables trong các hệ thống phức tạp.


            | Header1 | Header2 |
            |---------|---------|
            | Value1  | Value2  |

            | customer_Id | customer_Country_id |
            |-------------|---------------------|
            | 1           | 1                   |
            | 2           | 1                   |
            | 3           | 1                   |
            | 4           | 2                   |
            | 5           | 3                   |

                | order_Id | order_Customer_id |
                |----------|-------------------|
                | 1        | 1                 |
                | 2        | 1                 |
                | 3        | 1                 |
                | 4        | 2                 |
                | 5        | 3                 |