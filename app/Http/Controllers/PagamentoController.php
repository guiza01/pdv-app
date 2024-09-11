<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    public function index()
    {
        $pagamentos = Pagamento::with(['venda', 'formaDePagamento'])->get();
        return response()->json($pagamentos);
    }

    public function store(Request $request)
    {
        $validacao = $request->validate([
            'dataPagamento' => 'required|date',
            'venda_id' => 'nullable|exists:vendas,id',
            'formaDePagamento_id' => 'nullable|exists:forma_de_pagamentos,id',
            'valor' => 'required|numeric|min:0',
        ]);

        $pagamento = Pagamento::create($validacao);

        return response()->json($pagamento, 201);
    }

    public function show($id)
    {
        $pagamento = Pagamento::with(['venda', 'formaDePagamento'])->findOrFail($id);

        return response()->json($pagamento);
    }

    public function update(Request $request, $id)
    {
        $validacao = $request->validate([
            'dataPagamento' => 'required|date',
            'venda_id' => 'nullable|exists:vendas,id',
            'formaDePagamento_id' => 'nullable|exists:forma_de_pagamentos,id',
            'valor' => 'required|numeric|min:0',
        ]);

        $pagamento = Pagamento::findOrFail($id);
        $pagamento->update($validacao);

        return response()->json($pagamento);
    }

    public function destroy($id)
    {
        $pagamento = Pagamento::findOrFail($id);
        $pagamento->delete();

        return response()->json(['message' => 'Pagamento deletado com sucesso.']);
    }
}
