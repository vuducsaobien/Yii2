| order_Id | order_item_Order_id | order_item_Item_id |
|----------|---------------------|--------------------|
| 1        | 2                   | 3                  |
| 1        | 2                   | 3                  |

| order_Id | order_item_Order_id | order_item_Item_id | order_item_Item_id |
|----------|---------------------|--------------------|--------------------|
| 1        | 1                   | 1                  | 1                  |
| 2        | 1                   | 2                  | 1                  |

| order_Id | order_item_Order_id | order_item_Item_id | order_item_Item_id | order_item_Item_id |
|----------|---------------------|--------------------|--------------------|--------------------|
| 1        | 1                   | 1                  | 1                  | 1                  |
| 2        | 1                   | 2                  | 1                  | 1                  |

| order_Id | order_item_Order_id | order_item_Item_id | order_item_Item_id | order_item_Item_id | order_item_Item_id |
|----------|---------------------|--------------------|--------------------|--------------------|--------------------|
| 1        | 1                   | 1                  | 1                  | 1                  | 1                  |
| 2        | 1                   | 2                  | 1                  | 1                  | 1                  |


Order table         OrderItem table                                                 Item table
| order_Id |        |order_item_Id| order_item_Order_id | order_item_Item_id |      | item_Id |
|----------|        |-------------|---------------------|--------------------|      |---------|
| 1        |        | 1           | 1                   | 1                  |      | 1       |
| 2        |        | 2           | 1                   | 2                  |      | 2       |
| 3        |        | 2           | 2                   | 2                  |         
| 4        |
| 5        |
| 6        |
| 7        |


| customer_Id |
|-------------|
| 1           |
| 2           |
| 3           |
| 4           |
| 5           |


| Loại       | Tên gọi              | Cách chạy                                           | Ví dụ lệnh                                         | Khi chạy xong thì sao                 |
|------------|----------------------|-----------------------------------------------------|----------------------------------------------------|---------------------------------------|
| Foreground | (Chạy ở “tiền cảnh”) | Container chiếm terminal, bạn thấy output trực tiếp | `docker run nginx` hoặc `docker run -it alpine sh` | Container dừng khi bạn thoát terminal |
| Background | (Chạy ở “hậu cảnh”)  | Container chạy ngầm, không chiếm terminal           | `docker run -d nginx`                              | Container tiếp tục chạy, kể cả khi bạn đóng terminal |



| Loại         | Tên gọi                | Cách chạy                                   | Ví dụ lệnh                        | Khi chạy xong thì sao                   |
|--------------|------------------------|---------------------------------------------|-----------------------------------|-----------------------------------------|
| Foreground   | (Chạy ở “tiền cảnh”)   | Container chiếm terminal                    | `docker run nginx`                | Container dừng khi bạn thoát terminal   |
|              |                        | , bạn thấy output trực tiếp                 | hoặc `docker run -it alpine sh`   |                                         |
| ------------ | ---------------------- | ------------------------------------------- | --------------------------------- | --------------------------------------- |
| Background   | (Chạy ở “hậu cảnh”)    | Container chạy ngầm, không chiếm terminal   | `docker run -d nginx`             | Container tiếp tục chạy,                |
|              |                        | , bạn thấy output trực tiếp                 | hoặc `docker run -it alpine sh`   | kể cả khi bạn đóng                      |
|--------------|------------------------|---------------------------------------------|-----------------------------------|-----------------------------------------|


