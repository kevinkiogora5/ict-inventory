<?php

namespace Mcdcu\Projects\services\employees;

use Mcdcu\Projects\models\employees\employees;
use sigawa\mvccore\exception\ValidationException;

class employeesService
{
      public function getAll(): array
    {
        return employees::findAll();
    }

    public function create(array $data): ?employees
    {
        if (empty($data)) {
            throw new ValidationException(['Invalid data.']);
        }
        $items = new employees();
        $items->loadData($data);
        if(!$items->validate()) {
            throw new ValidationException($items->getErrorMessages());
        }
        if (!$items->save()) {
            throw new ValidationException($items->getErrorMessages());
        }
        return $items;
    }

    public function update(int $id, array $data) : ?employees
    {
        $items = employees::findOne(['id' => $id]);
        if(!$items){
            throw new ValidationException(['Item not found.']);
        }
        $items->loadData($data);
        if (!$items->save()) {
            throw new ValidationException($items->getErrors());
        }
        return $items;
    }

    public function delete(int $id): bool
    {
        $items = employees::findOne(['id' => $id]);
        if(!$items){
            throw new ValidationException(['Item not found.']);
        }
        return $items->delete();
    }

    public function search(string $term, array $columns, ?int $limit = null): array
    {
        return employees::search($term, $columns, $limit);
    }
}