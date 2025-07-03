<?php

namespace Mcdcu\Projects\services\returns;

use Mcdcu\Projects\models\returns\returns;
use sigawa\mvccore\exception\ValidationException;

class returnService
{
    public function getAll(): array
    {
        return returns::findAll();
    }

    public function create(array $data): ?returns
    {
        if (empty($data)) {
            throw new ValidationException(['Invalid data.']);
        }
        $items = new returns();
        $items->loadData($data);
        if(!$items->validate()) {
            throw new ValidationException($items->getErrorMessages());
        }
        if (!$items->save()) {
            throw new ValidationException($items->getErrorMessages());
        }
        return $items;
    }

    public function update(int $id, array $data) : ?returns
    {
        $items = returns::findOne(['id' => $id]);
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
        $items = returns::findOne(['id' => $id]);
        if(!$items){
            throw new ValidationException(['Item not found.']);
        }
        return $items->delete();
    }

    public function search(string $term, array $columns, ?int $limit = null): array
    {
        return returns::search($term, $columns, $limit);
    }
}