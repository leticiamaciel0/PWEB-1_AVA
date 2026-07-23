<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Resources\ProdutoResource;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoApiController extends Controller
{
    // GET /api/recurso (Com filtro e paginação - Diferencial)
    public function index(Request $request)
    {
        $query = Produto::with('categoria');

        if ($request->has('nome')) {
            $query->where('nome', 'like', '%' . $request->nome . '%');
        }

        return ProdutoResource::collection($query->paginate(10));
    }

    // POST /api/recurso
    public function store(StoreProdutoRequest $request)
    {
        $produto = Produto::create($request->validated());
        return (new ProdutoResource($produto))
            ->response()
            ->setStatusCode(201);
    }

    // GET /api/recurso/{id}
    public function show(Produto $produto)
    {
        return new ProdutoResource($produto);
    }

    // PUT /api/recurso/{id}
    public function update(StoreProdutoRequest $request, Produto $produto)
    {
        $produto->update($request->validated());
        return new ProdutoResource($produto);
    }

    // DELETE /api/recurso/{id}
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return response()->json(['message' => 'Removido com sucesso.'], 200);
    }
}