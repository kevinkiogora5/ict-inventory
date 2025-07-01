<?php

namespace Mcdcu\Projects\controllers\inventory_categories;

use Mcdcu\Projects\models\inventory_categories\inventory_categories;
use Mcdcu\Projects\services\inventory_categories\inventory_categoriesService;
use sigawa\mvccore\Request;
use sigawa\mvccore\Response;
use sigawa\mvccore\Controller;

class inventory_categoriesController extends Controller
{
   protected inventory_categoriesService $service;

    public function __construct()
    {
        $this->service = new inventory_categoriesService();
    }

    public function index()
    {
        $categories = $this->service->getAll();
        return $this->render('inventory_categories/index', ['categories' => $categories]);
    }

    public function create(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $data = $request->getBody();
            $result = $this->service->create($data);
            if ($result) {
                $response->redirect('/inventory-categories');
                return;
            }
            return $this->render('inventory_categories/create', ['error' => 'Failed to create category.']);
        }

        return $this->render('inventory_categories/create');
    }

    public function update(Request $request, Response $response)
    {
        $id = $request->getParam('id');
        if ($request->isPost()) {
            $data = $request->getBody();
            if ($this->service->update((int)$id, $data)) {
                $response->redirect('/inventory-categories');
                return;
            }
            return $this->render('inventory_categories/update', ['error' => 'Update failed.']);
        }

        $category = inventory_categories::findbyId((int)$id);
        return $this->render('inventory_categories/update', ['category' => $category]);
    }

    public function delete(Request $request, Response $response)
    {
        $id = $request->getParam('id');
        $this->service->delete((int)$id);
        $response->redirect('/inventory-categories');
    }

    public function search(Request $request)
    {
        $term = $request->getParam('term');
        $categories = $this->service->search($term, ['type', 'description']);
        return $this->render('inventory_categories/index', ['categories' => $categories]);
    }

}