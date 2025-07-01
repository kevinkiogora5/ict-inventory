<?php

namespace Mcdcu\Projects\controllers\returns;

use Mcdcu\Projects\services\ReturnService;
use Mcdcu\Projects\models\returns\returns;
use sigawa\mvccore\Controller;
use sigawa\mvccore\Request;
use sigawa\mvccore\Response;

class ReturnController extends Controller
{
    protected ReturnService $service;

    public function __construct()
    {
        $this->service = new ReturnService();
    }

    public function index()
    {
        $returns = $this->service->getAll();
        return $this->render('returns/index', ['returns' => $returns]);
    }

    public function create(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $data = $request->getBody();
            $result = $this->service->create($data);
            if ($result) {
                $response->redirect('/returns');
                return;
            }
            return $this->render('returns/create', ['error' => 'Failed to create return record.']);
        }

        return $this->render('returns/create');
    }

    public function update(Request $request, Response $response)
    {
        $id = $request->getParam('id');
        if ($request->isPost()) {
            $data = $request->getBody();
            if ($this->service->update((int)$id, $data)) {
                $response->redirect('/returns');
                return;
            }
            return $this->render('returns/update', ['error' => 'Update failed.']);
        }

        $return = returns::findbyId((int)$id);
        return $this->render('returns/update', ['return' => $return]);
    }

    public function delete(Request $request, Response $response)
    {
        $id = $request->getParam('id');
        $this->service->delete((int)$id);
        $response->redirect('/returns');
    }

    public function search(Request $request)
    {
        $term = $request->getParam('term');
        $results = $this->service->search($term, ['returned_condition', 'comments']);
        return $this->render('returns/index', ['returns' => $results]);
    }
}
