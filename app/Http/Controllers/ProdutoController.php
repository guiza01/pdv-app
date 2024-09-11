<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return response()->json($produtos);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'descricao' => 'required|string|max:1000',
        ]);

        $produto = Produto::create($validated);

        return response()->json($produto, 201);
    }

    public function show($id)
    {
        $produto = Produto::findOrFail($id);

        return response()->json($produto);
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'descricao' => 'required|string|max:1000',
        ]);

        $produto = Produto::findOrFail($id);
        $produto->update($validated);

        return response()->json($produto);
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return response()->json(['message' => 'Produto deletado com sucesso.']);
    }
}
