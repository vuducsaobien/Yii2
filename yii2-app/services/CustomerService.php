<?php

namespace app\services;

class CustomerService extends BaseService
{
    /**
     * Lấy danh sách customer không có relation (gây ra N+1 problem)
     */
    public function getList(): array
    {
        return $this->customerModel::find()->all();
    }

    /**
     * Lấy danh sách customer với eager loading relations (tránh N+1 problem)
     * @param array $relations Mảng các relation cần load: ['orders', 'country']
     */
    public function getListWithRelations(array $relations = [], $asArray = false): array
    {
        $query = $this->customerModel::find();

        if (!empty($relations)) {
            $query->with($relations);
        }

        if ($asArray) {
            $query->asArray();
        }
    
        return $query->all();
    }
    
    /**
     * Generic method để lấy customers với bất kỳ relations nào
     * @param array $relations Array of relations to load: ['orders', 'country', 'items']
     * @return array
     */
    public function getListWithCustomRelations(array $relations): array
    {
        return $this->customerModel::find()->withCustomRelation($relations)->all();
    }
   
    public function getItems(): array
    {   
        // eager loading with nested relations
        return $this->customerModel::find()->with(['orders.items'])->asArray()->all();
    }
}
