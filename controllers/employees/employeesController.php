<?php

namespace Mcdcu\Projects\controllers\employees;

use Mcdcu\Projects\services\employees\employeesService;
use sigawa\mvccore\Request;
use sigawa\mvccore\Response;
use sigawa\mvccore\Controller;
use sigawa\mvccore\exception\ValidationException;

class employeesController extends Controller
{
        protected employeesService $employeeService;

    public function __construct()
    {
        $this->employeeService = new employeesService();
    }

    public function index(): string
    {
        $employees = $this->employeeService->getAll();
        $this->setLayout("admin");
        return $this->render('employees', ['employees' => $employees]);
    }

    
    public function create(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $data = $request->getBody();
            try { 
                $item = $this->employeeService->create($data);
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
                $item = $this->employeeService->update((int)$id, $data);
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
            $this->employeeService->delete((int)$id);
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
        $items = $this->employeeService->search($term, ['name', 'description', 'brand', 'serial_number']);
        return $this->render('inventory_items/index', ['items' => $items]);
    }

}