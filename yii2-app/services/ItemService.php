<?php

namespace app\services;

class ItemService extends BaseService
{
    public function getList(): array
    {
        return $this->itemModel::find()->with(['orders', 'orderItems'])->asArray()->all();
    }
}
