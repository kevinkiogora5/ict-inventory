<?php

namespace Mcdcu\Projects\controllers\inventory_items;

use Mcdcu\Projects\models\inventory_items\inventory_items;
use Mcdcu\Projects\services\InventoryItemsService;
use sigawa\mvccore\Controller;
use sigawa\mvccore\Request;
use sigawa\mvccore\Response;

class InventoryItemsController extends Controller
{
     protected InventoryItemsService $service;

    public function __construct()
    {
        $this->service = new InventoryItemsService();
    }

    public function index()
    {
        $items = $this->service->getAll();
        return $this->render('inventory_items/index', ['items' => $items]);
    }

    public function create(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $data = $request->getBody();
            $item = $this->service->create($data);
            if ($item) {
                $response->redirect('/inventory-items');
                return;
            }
            return $this->render('inventory_items/create', ['error' => 'Failed to create item.']);
        }

        return $this->render('inventory_items/create');
    }

    public function update(Request $request, Response $response)
    {
        $id = $request->getParam('id');
        if ($request->isPost()) {
            $data = $request->getBody();
            if ($this->service->update((int)$id, $data)) {
                $response->redirect('/inventory-items');
                return;
            }
            return $this->render('inventory_items/update', ['error' => 'Update failed.']);
        }

        $item = inventory_items::findbyId((int)$id);
        return $this->render('inventory_items/update', ['item' => $item]);
    }

    public function delete(Request $request, Response $response)
    {
        $id = $request->getParam('id');
        $this->service->delete((int)$id);
        $response->redirect('/inventory-items');
    }

    public function search(Request $request)
    {
        $term = $request->getParam('term');
        $items = $this->service->search($term, ['name', 'description', 'brand', 'serial_number']);
        return $this->render('inventory_items/index', ['items' => $items]);
    }
}