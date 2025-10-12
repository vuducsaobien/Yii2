<?php

namespace app\services;

class CustomerService extends BaseService
{
    public function getList(): array
    {
        return $this->customerModel::find()->all();
    }

    public function getListWithRelations(array $relations = []): array
    {
        $query = $this->customerModel::find();

        if (!empty($relations)) {
            $query->with($relations);
        }
    
        return $query->all();
    }
}
