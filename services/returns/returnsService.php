<?php

namespace Mcdcu\Projects\services;

use Mcdcu\Projects\models\returns\returns;

class ReturnService
{
    public function getAll(): array
    {
        return returns::find_returns();
    }

    public function create(array $data): ?returns
    {
        return returns::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return returns::updateById($id, $data);
    }

    public function delete(int $id): bool
    {
        return returns::deleteById($id);
    }

    public function search(string $term, array $columns, ?int $limit = null): array
    {
        return returns::search($term, $columns, $limit);
    }
}
