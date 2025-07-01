<?php

namespace Mcdcu\Projects\controllers\employees;

use Mcdcu\Projects\models\employees\employees;
use Mcdcu\Projects\services\employees\employeesService;
use sigawa\mvccore\Request;
use sigawa\mvccore\Response;
use sigawa\mvccore\Controller;

class employeesController extends Controller
{
        protected EmployeesService $employeeService;

    public function __construct()
    {
        $this->employeeService = new EmployeesService();
    }

    public function index()
    {
        $employees = $this->employeeService->getAllEmployees();
        return $this->render('employee/index', ['employees' => $employees]);
    }

    public function create(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $data = $request->getBody();
            $result = $this->employeeService->createEmployee($data);
            if ($result) {
                $response->redirect('/employees');
                return;
            }
            return $this->render('employee/create', ['error' => 'Failed to create employee']);
        }

        return $this->render('employee/create');
    }

    public function update(Request $request, Response $response)
    {
        $id = $request->getParam('id');
        if ($request->isPost()) {
            $data = $request->getBody();
            if ($this->employeeService->updateEmployee((int)$id, $data)) {
                $response->redirect('/employees');
                return;
            }
            return $this->render('employee/update', ['error' => 'Update failed']);
        }

        $employee = employees::findbyId((int)$id);
        return $this->render('employee/update', ['employee' => $employee]);
    }

    public function delete(Request $request, Response $response)
    {
        $id = $request->getParam('id');
        $this->employeeService->deleteEmployee((int)$id);
        $response->redirect('/employees');
    }

    public function search(Request $request)
    {
        $term = $request->getParam('term');
        $employees = $this->employeeService->searchEmployees($term, ['first_name', 'last_name', 'email', 'phone']);
        return $this->render('employee/index', ['employees' => $employees]);
    }


}