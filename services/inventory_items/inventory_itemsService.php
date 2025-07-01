<?php

namespace Mcdcu\Projects\services;

use Mcdcu\Projects\models\inventory_items\inventory_items;

class InventoryItemsService
{
    public function getAll(): array
    {
        return inventory_items::find_inventory_items();
    }

    public function create(array $data): ?inventory_items
    {
        return inventory_items::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return inventory_items::updateById($id, $data);
    }

    public function delete(int $id): bool
    {
        return inventory_items::deleteById($id);
    }

    public function search(string $term, array $columns, ?int $limit = null): array
    {
        return inventory_items::search($term, $columns, $limit);
    }
}
// someway to interact with the inventory_items model.