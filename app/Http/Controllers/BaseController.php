<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController extends Controller
{

    protected $resource;

    public function index()
    {

        $resource = $this->resource::paginate();
        return response()->json($resource, 200, ['Content-Type: application/json']);
    }

    public function store(Request $request)
    {
        $resource = $this->resource::create($request->all());
        return response()->json($resource, 201, ['Content-Type: application/json']);
    }

    public function show(int $id)
    {
        $serie = $this->resource::find($id);

        if (!$serie) {
            return response()->json(["message" => 'Recurso não encontrado'], 404);
        }

        return response()->json($serie, 200);
    }

    public function update(Request $request, int $id)
    {
        $resource = $this->resource::find($id);
        if (is_null($resource)) {
            return response()->json(["message" => 'Recurso não encontrado'], 404);
        }

        $resource->fill($request->all());
        if (!$resource->save()) {
            return response()->json(["message" => 'Erro ao tentar atualizar este recurso'], 404);
        }

        return response()->json($resource, 200, ['Content-Type: application/json']);
    }

    public function destroy(int $id)
    {

        $rows = $this->resource::destroy($id);

        if ($rows <= 0) {
            return response()->json('', 404);
        }

        return response()->json(['message '=> "Recurso removido com sucesso!"], 200, ['Content-Type: application/json']);
    }

}
