<?php
/**
 * Yii2 via() Relation Demo
 * 
 * This file demonstrates how to use the via() method in Yii2 Active Record
 * to create many-to-many relationships through junction tables.
 */

// Example 1: Order -> OrderItem -> Item (via orderItems)
echo "=== Example 1: Order -> OrderItem -> Item ===\n";

// Get an order with its items using via() relation
$order = \app\models\base\Order::find()
    ->with(['items']) // This uses the via('orderItems') relationship
    ->one();

if ($order) {
    echo "Order #{$order->order_number} has the following items:\n";
    foreach ($order->items as $item) {
        echo "- {$item->name} (Price: {$item->price})\n";
    }
}

// Example 2: Customer -> Order -> OrderItem -> Item (via multiple relationships)
echo "\n=== Example 2: Customer -> Order -> OrderItem -> Item ===\n";

$customer = \app\models\base\Customer::find()
    ->with(['items']) // This uses the via('orderItems') relationship
    ->one();

if ($customer) {
    echo "Customer {$customer->name} has ordered the following items:\n";
    foreach ($customer->items as $item) {
        echo "- {$item->name} (Price: {$item->price})\n";
    }
}

// Example 3: Item -> OrderItem -> Order (via orderItems)
echo "\n=== Example 3: Item -> OrderItem -> Order ===\n";

$item = \app\models\base\Item::find()
    ->with(['orders']) // This uses the via('orderItems') relationship
    ->one();

if ($item) {
    echo "Item '{$item->name}' is in the following orders:\n";
    foreach ($item->orders as $order) {
        echo "- Order #{$order->order_number} (Status: {$order->status})\n";
    }
}

/**
 * Key Points about via() method:
 * 
 * 1. Junction Table Pattern:
 *    - via() allows you to define many-to-many relationships through intermediate tables
 *    - Example: Order <-> OrderItem <-> Item
 * 
 * 2. Two-Step Join:
 *    - Step 1: Join Order -> OrderItem (via 'orderItems' relation)
 *    - Step 2: Join OrderItem -> Item (via item_id)
 * 
 * 3. Query Optimization:
 *    - Uses eager loading with with() to avoid N+1 query problem
 *    - Executes only 3 queries instead of multiple queries per record
 * 
 * 4. Alternative Syntax:
 *    Instead of ->via('orderItems'), you could also use:
 *    ->via(function($query) {
 *        $query->from(OrderItem::tableName());
 *    })
 * 
 * 5. Relationship Chain:
 *    - Customer -> Orders (direct)
 *    - Customer -> OrderItems (via orders)
 *    - Customer -> Items (via orderItems)
 */
