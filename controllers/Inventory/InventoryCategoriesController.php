<?php

namespace Mcdcu\Projects\controllers\Inventory;

use Mcdcu\Projects\services\Inventory\InventoryCategoriesService;
use sigawa\mvccore\Request;
use sigawa\mvccore\Response;
use sigawa\mvccore\Controller;
use sigawa\mvccore\exception\ValidationException;

class InventoryCategoriesController extends Controller
{
    protected InventoryCategoriesService $service;

    public function __construct()
    {
        $this->service = new InventoryCategoriesService();
    }

    public function index()
    {
        $categories = $this->service->getAll();
        $this->setLayout("admin");
        return $this->render('categories', ['categories' => $categories]);
    }
    public function create(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $data = $request->getBody();
            try { 
                $item = $this->service->create($data);
                return $response->json(['message' =>'Item created successfully.','data' => $item]);
            } catch (ValidationException $th) {
                //throw $th;
                return $response->json(['error' => $th->errors], 400);
            }
           
        }

        return $response->json(['error' => 'Invalid request method.'],400);
    }

    public function update(Request $request, Response $response)
    {
        if ($request->isPut()) {
            $data = $request->getBody();
            try {
                $id = $request->getParam('id');
                $item = $this->service->update((int)$id, $data);
                return $response->json(['message' => 'Item updated successfully.', 'data' => $item]);
            } catch (ValidationException $th) {
                return $response->json(['error' => $th->errors], 400);
            }
        }
          return $response->json(['error' => 'Invalid request method.'],400);
    }

    public function delete(Request $request, Response $response)
    {
    if ($request->isDelete()) {
        try {
            $id = $request->getParam('id');
            $this->service->delete((int)$id);
            return $response->json(['message' => 'Item deleted successfully.']);
        } catch (ValidationException $th) {
            return $response->json(['error' => $th->errors], 400);
        }
    }
     return $response->json(['error' => 'Invalid request method.'],400);
    }

    public function search(Request $request)
    {
        $term = $request->getParam('term');
        $items = $this->service->search($term, ['name', 'description', 'brand', 'serial_number']);
        return $this->render('inventory_items/index', ['items' => $items]);
    }

}