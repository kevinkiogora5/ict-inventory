<?php

namespace Mcdcu\Projects\services\inventory_categories;

use Mcdcu\Projects\models\inventory_categories\inventory_categories;

class inventory_categoriesService
{
    public function getAll(): array
    {
        return inventory_categories::find_inventory_categories();
    }

    public function create(array $data): ?inventory_categories
    {
        return inventory_categories::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return inventory_categories::updateById($id, $data);
    }

    public function delete(int $id): bool
    {
        return inventory_categories::deleteById($id);
    }

    public function search(string $term, array $columns, ?int $limit = null): array
    {
        return inventory_categories::search($term, $columns, $limit);
    }
}