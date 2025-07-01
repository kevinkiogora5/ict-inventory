<?php

namespace Mcdcu\Projects\controllers;

use Mcdcu\Projects\services\InventoryItemsService;
use sigawa\mvccore\core\Controller;
use sigawa\mvccore\http\Request;
use sigawa\mvccore\http\Response;

class InventoryItemsController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $items = InventoryItemsService::getAllItems();
        return $response->json($items);
    }

    public function show(Request $request, Response $response, int $id)
    {
        $item = InventoryItemsService::getItemById($id);
        if (!$item) {
            return $response->json(['error' => 'Item not found'], 404);
        }
        return $response->json($item);
    }

    public function store(Request $request, Response $response)
    {
        $data = $request->getBody();
        $newItem = InventoryItemsService::createItem($data);

        if (!$newItem) {
            return $response->json(['error' => 'Failed to create item'], 400);
        }

        return $response->json($newItem, 201);
    }

    public function update(Request $request, Response $response, int $id)
    {
        $data = $request->getBody();
        $updated = InventoryItemsService::updateItem($id, $data);

        if (!$updated) {
            return $response->json(['error' => 'Failed to update item or item not found'], 400);
        }

        return $response->json(['message' => 'Item updated successfully']);
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $deleted = InventoryItemsService::deleteItem($id);

        if (!$deleted) {
            return $response->json(['error' => 'Failed to delete item or item not found'], 400);
        }

        return $response->json(['message' => 'Item deleted successfully']);
    }

    public function search(Request $request, Response $response)
    {
        $query = $request->getQueryParams();
        $term = $query['term'] ?? '';
        $columns = explode(',', $query['columns'] ?? 'name,description,brand,model');
        $limit = isset($query['limit']) ? (int)$query['limit'] : null;

        $results = InventoryItemsService::searchItems($term, $columns, $limit);

        return $response->json($results);
    }
}
/*
 * InventoryItemsController handles CRUD operations and search for inventory items.
 * Methods:
 *   - index: List all inventory items.
 *   - show: Get a single item by ID.
 *   - store: Create a new inventory item.
 *   - update: Update an existing item by ID.
 *   - delete: Remove an item by ID.
 *   - search: Search items by term and columns.
 */