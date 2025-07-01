<?php

namespace Mcdcu\Projects\controllers\department;

use Mcdcu\Projects\models\department\department;
use Mcdcu\Projects\services\department\departmentService;
use sigawa\mvccore\Request;
use sigawa\mvccore\Response;
use sigawa\mvccore\Controller;

class departmentController extends Controller
{
    protected departmentService $departmentService;

    public function __construct()
    {
        $this->departmentService = new departmentService();
    }
    public function index(Request $request, Response $response) {
        $departments = $this->departmentService->getAllDepartments();
        return $this->render('department/index', ['departments' => $departments]);
    }

    public function create(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $data = $request->getBody();
            $newDept = $this->departmentService->createDepartment($data);

            if ($newDept) {
                $response->redirect('/departments');
                return;
            }
            return $this->render('department/create', ['error' => 'Failed to create department']);
        }

        return $this->render('department/create');
    }

    public function update(Request $request, Response $response)
    {
        $id = $request->getParam('id');
        if ($request->isPost()) {
            $data = $request->getBody();
            if ($this->departmentService->updateDepartment((int)$id, $data)) {
                $response->redirect('/departments');
                return;
            }
            return $this->render('department/update', ['error' => 'Update failed']);
        }

        $department = department::findbyId((int)$id);
        return $this->render('department/update', ['department' => $department]);
    }

    public function delete(Request $request, Response $response)
    {
        $id = $request->getParam('id');
        if ($this->departmentService->deleteDepartment((int)$id)) {
            $response->redirect('/departments');
            return;
        }
        return $this->render('department/index', ['error' => 'Failed to delete department']);
    }

    public function search(Request $request)
    {
        $term = $request->getParam('term');
        $departments = $this->departmentService->searchDepartments($term, ['name', 'description']);
        return $this->render('department/index', ['departments' => $departments]);
    }

}