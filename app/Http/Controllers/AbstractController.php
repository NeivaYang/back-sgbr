<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class AbstractController extends Controller
{
    protected $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->listAll());
    }

    public function store(Request $request)
    {
        return response()->json($this->service->create($request->all()));
    }

    public function update(Request $request, int $id)
    {
        return response()->json($this->service->update($id, $request->all()));
    }

    public function destroy(int $id)
    {
        $res = $this->service->delete($id);

        if (!$res) {
            return response()->json(['message' => 'Erro ao deletar o registro'], 500);
        }

        return response()->json(['message' => 'Registro deletado com sucesso'], 200);
    }

    public function findById(int $id)
    {
        $record = $this->service->findById($id);

        if (!$record) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }

        return response()->json($record);
    }

    public function search(Request $request)
    {
        $query = $request->query('query');
        if (!$query) {
            return $this->index();
        }
        return response()->json($this->service->search($query));
    }
}
