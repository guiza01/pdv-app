<?php

namespace App\Http\Controllers;

use App\Models\ItemVenda;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemVendaController extends Controller
{
    public function index()
    {
        $itensVenda = ItemVenda::with(['venda', 'produto'])->get();
        return response()->json($itensVenda);
    }

    public function store(Request $request)
    {
        $validacao = $request->validate([
            'venda_id' => 'nullable|exists:vendas,id',
            'produto_id' => 'nullable|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'precoUnitario' => 'required|numeric|min:0',
            'subTotal' => 'required|numeric|min:0',
        ]);

        $itemVenda = ItemVenda::create($validacao);

        return response()->json($itemVenda, 201);
    }

    public function show($id)
    {
        $itemVenda = ItemVenda::with(['venda', 'produto'])->findOrFail($id);

        return response()->json($itemVenda);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'venda_id' => 'nullable|exists:vendas,id',
            'produto_id' => 'nullable|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'precoUnitario' => 'required|numeric|min:0',
            'subTotal' => 'required|numeric|min:0',
        ]);

        $itemVenda = ItemVenda::findOrFail($id);
        $itemVenda->update($validated);

        return response()->json($itemVenda);
    }

    public function destroy($id)
    {
        $itemVenda = ItemVenda::findOrFail($id);
        $itemVenda->delete();   

        return response()->json(['message' => 'Item de venda deletado com sucesso.']);
    }
}
