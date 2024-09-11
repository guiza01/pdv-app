<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function index()
    {
        $vendas = Venda::with(['cliente', 'formaDePagamento'])->get();
        return response()->json($vendas);
    }

    public function store(Request $request)
    {
        $validacao = $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'formaDePagamento_id' => 'nullable|exists:forma_de_pagamentos,id',
        ]);

        $venda = Venda::create($validacao);

        return response()->json($venda, 201);
    }

    public function show($id)
    {
        $venda = Venda::with(['cliente', 'formaDePagamento'])->findOrFail($id);

        return response()->json($venda);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'formaDePagamento_id' => 'nullable|exists:forma_de_pagamentos,id',
        ]);

        $venda = Venda::findOrFail($id);
        $venda->update($validated);

        return response()->json($venda);
    }

    public function destroy($id)
    {
        $venda = Venda::findOrFail($id);
        $venda->delete();

        return response()->json(['message' => 'Venda deletada com sucesso.']);
    }
}
