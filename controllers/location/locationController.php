<?php

namespace Mcdcu\Projects\controllers\location;

use Mcdcu\Projects\services\LocationService;
use Mcdcu\Projects\models\location\location;
use sigawa\mvccore\Controller;
use sigawa\mvccore\Request;
use sigawa\mvccore\Response;

class LocationController extends Controller
{
    protected LocationService $service;

    public function __construct()
    {
        $this->service = new LocationService();
    }

    public function index()
    {
        $locations = $this->service->getAll();
        return $this->render('location/index', ['locations' => $locations]);
    }

    public function create(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $data = $request->getBody();
            $result = $this->service->create($data);
            if ($result) {
                $response->redirect('/locations');
                return;
            }
            return $this->render('location/create', ['error' => 'Failed to create location.']);
        }

        return $this->render('location/create');
    }

    public function update(Request $request, Response $response)
    {
        $id = $request->getParam('id');
        if ($request->isPost()) {
            $data = $request->getBody();
            if ($this->service->update((int)$id, $data)) {
                $response->redirect('/locations');
                return;
            }
            return $this->render('location/update', ['error' => 'Update failed.']);
        }

        $location = location::findbyId((int)$id);
        return $this->render('location/update', ['location' => $location]);
    }

    public function delete(Request $request, Response $response)
    {
        $id = $request->getParam('id');
        $this->service->delete((int)$id);
        $response->redirect('/locations');
    }

    public function search(Request $request)
    {
        $term = $request->getParam('term');
        $locations = $this->service->search($term);
        return $this->render('location/index', ['locations' => $locations]);
    }
}
