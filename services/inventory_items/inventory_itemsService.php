<?php

namespace Mcdcu\Projects\services;

use Mcdcu\Projects\models\inventory_items\inventory_items;

class InventoryItemsService
{
    public static function getAllItems(): array
    {
        return inventory_items::find_inventory_items();
    }

    public static function getItemById(int $id): ?inventory_items
    {
        return inventory_items::findById($id);
    }

    public static function createItem(array $data): ?inventory_items
    {
        return inventory_items::create($data);
    }

    public static function updateItem(int $id, array $data): bool
    {
        return inventory_items::updateById($id, $data);
    }

    public static function deleteItem(int $id): bool
    {
        return inventory_items::deleteById($id);
    }

    public static function searchItems(string $term, array $columns, ?int $limit = null): array
    {
        return inventory_items::search($term, $columns, $limit);
    }
}
// someway to interact with the inventory_items model.