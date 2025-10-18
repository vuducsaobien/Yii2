https://www.yiiframework.com/doc/guide/2.0/en/db-active-record

Relations via a Junction Table
In database modelling, when the multiplicity between two related tables is many-to-many, a junction table is usually introduced. For example, the order table and the item table may be related via a junction table named order_item. One order will then correspond to multiple order items, while one product item will also correspond to multiple order items.

When declaring such relations, you would call either via() or viaTable() to specify the junction table. The difference between via() and viaTable() is that the former specifies the junction table in terms of an existing relation name while the latter directly uses the junction table. For example,

```php
class Order extends ActiveRecord
{
    // Order → Item
    public function getItems()
    {
        return $this->hasMany(Item::class, ['item_Id' => 'order_item_Item_id'])
            ->viaTable('order_items', ['order_item_Order_id' => 'order_Id']);
    }
}
```
or alternatively,
```php
class Order extends ActiveRecord
{
    // Order → OrderItem → Item
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
    }

    public function getItems()
    {
        return $this->hasMany(Item::class, ['id' => 'item_id'])
            ->via('orderItems');
    }
}
```

=> Via & viaTable chỉ qua 3 Table: Order → OrderItem (Junction Table) → Item


| order_item_Id | order_item_Id | order_item_Id|
|----------|----------|----------|
| 1        |1|1
| 2        |2|1
| 3        |3|1


            | order_Id | order_item_Order_id | order_item_Item_id |
            |----------|---------------------|--------------------|
            | 1        | 1                   | 1                  |
            | 2        | 1                   | 1                  |
            | 3        | 1                   | 1                  |
