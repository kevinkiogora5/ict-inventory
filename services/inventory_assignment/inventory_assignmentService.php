<?php

namespace Mcdcu\Projects\services\inventory_assignment;

use Mcdcu\Projects\models\inventory_assignment\inventory_assignment;

class inventory_assignmentService
{
    public function getAll(): array
    {
        return inventory_assignment::find_inventory_assignment();
    }

    public function create(array $data): ?inventory_assignment
    {
        return inventory_assignment::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return inventory_assignment::updateById($id, $data);
    }

    public function delete(int $id): bool
    {
        return inventory_assignment::deleteById($id);
    }

    public function search(string $term, array $columns, ?int $limit = null): array
    {
        return inventory_assignment::search($term, $columns, $limit);
    }
}
