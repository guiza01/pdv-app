<?php

namespace App\Http\Controllers;

use app\Models\FormaDePagamento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormaDePagamentoController extends Controller
{
    public function index()
    {
        $formasDePagamento = FormaDePagamento::all();
        return response()->json($formasDePagamento);
    }

    public function store(Request $request)
    {
        $validacao = $request->validate([
            'descricao' => 'required|string|max:255',
        ]);

        $formaDePagamento = FormaDePagamento::create($validacao);

        return response()->json($formaDePagamento, 201);
    }

    public function show($id)
    {
        $formaDePagamento = FormaDePagamento::findOrFail($id);

        return response()->json($formaDePagamento);
    }

    public function update(Request $request, $id)
    {
        $validacao = $request->validate([
            'descricao' => 'required|string|max:255',
        ]);

        $formaDePagamento = FormaDePagamento::findOrFail($id);
        $formaDePagamento->update($validacao);

        return response()->json($formaDePagamento);
    }

    public function destroy($id)
    {
        $formaDePagamento = FormaDePagamento::findOrFail($id);
        $formaDePagamento->delete();

        return response()->json(['message' => 'Forma de pagamento deletada com sucesso.']);
    }
}
