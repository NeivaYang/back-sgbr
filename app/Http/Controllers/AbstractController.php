<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

abstract class AbstractController
{
    protected $service;
    protected string $viewPath;

    public function __construct($service, string $viewPath)
    {
        $this->service = $service;
        $this->viewPath = $viewPath;
    }

    public function index()
    {
        $data = $this->service->paginate(15);

        return View::make("{$this->viewPath}.index", compact('data'));
    }

    public function create()
    {
        return View::make("{$this->viewPath}.create");
    }

    public function store(Request $request)
    {
        $this->service->create($request->all());

        return redirect()->route("{$this->viewPath}.index")->with('success', 'Registro criado com sucesso!');
    }

    public function edit(int $id)
    {
        $record = $this->service->findById($id);

        return View::make("{$this->viewPath}.edit", compact('record'));
    }

    public function update(Request $request, int $id)
    {
        $this->service->update($id, $request->all());

        return redirect()->route("{$this->viewPath}.index")->with('success', 'Registro atualizado com sucesso!');
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);

        return redirect()->route("{$this->viewPath}.index")->with('success', 'Registro excluído com sucesso!');
    }

    public function search(Request $request)
    {
        if (!$request->value) {
            return $this->index();
        }
        $data = $this->service->search($request->value);
        return response()->json([
            'data' => $data->items(),
            'links' => $data->appends(['value' => $request->value])->links('pagination::tailwind')->toHtml()
        ]);
    }
}
