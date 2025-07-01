<?php

namespace Mcdcu\Projects\controllers\inventory_assignment;

use Mcdcu\Projects\models\inventory_assignment\inventory_assignment;
use Mcdcu\Projects\services\inventory_assignment\inventory_assignmentService;
use sigawa\mvccore\Request;
use sigawa\mvccore\Response;
use sigawa\mvccore\Controller;

class inventory_assignmentController extends Controller
{
    protected inventory_assignmentService $service;

    public function __construct()
    {
        $this->service = new inventory_assignmentService();
    }

    public function index()
    {
        $assignments = $this->service->getAll();
        return $this->render('inventory_assignment/index', ['assignments' => $assignments]);
    }

    public function create(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $data = $request->getBody();
            $result = $this->service->create($data);
            if ($result) {
                $response->redirect('/inventory-assignment');
                return;
            }
            return $this->render('inventory_assignment/create', ['error' => 'Failed to assign inventory.']);
        }

        return $this->render('inventory_assignment/create');
    }

    public function update(Request $request, Response $response)
    {
        $id = $request->getParam('id');
        if ($request->isPost()) {
            $data = $request->getBody();
            if ($this->service->update((int)$id, $data)) {
                $response->redirect('/inventory-assignment');
                return;
            }
            return $this->render('inventory_assignment/update', ['error' => 'Update failed']);
        }

        $assignment = inventory_assignment::findbyId((int)$id);
        return $this->render('inventory_assignment/update', ['assignment' => $assignment]);
    }

    public function delete(Request $request, Response $response)
    {
        $id = $request->getParam('id');
        $this->service->delete((int)$id);
        $response->redirect('/inventory-assignment');
    }

    public function search(Request $request)
    {
        $term = $request->getParam('term');
        $assignments = $this->service->search($term, ['employee_id', 'inventory_item_id', 'notes']);
        return $this->render('inventory_assignment/index', ['assignments' => $assignments]);
    }

}