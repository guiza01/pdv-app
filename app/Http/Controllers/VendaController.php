<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\FormaDePagamento;
use App\Models\Produto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function index()
    {
        $vendas = Venda::with(['cliente', 'formaDePagamento'])->get();
        //return view('venda', compact('vendas'));

        $clientes = Cliente::all();
        $formasDePagamento = FormaDePagamento::all();

        return view('venda', [
            'vendas' => $vendas,
        ]);
    }

    public function store(Request $request)
    {
        $validacao = $request->validate([
            'cliente_nome' => 'nullable|exists:clientes,id',
            'parcelas' => 'nullable|numeric|min:1',
            'data_pagamento' => 'required|date',
            'valor_total' => 'required|numeric|min:0',
            'produtos' => 'nullable|array',
            'produtos.*.id' => 'required|exists:produtos,id',
            'produtos.*.quantidade' => 'required|numeric|min:1',
            'produtos.*.valor' => 'required',

        ]);


        $venda = Venda::create([
            'cliente_id' => $validacao['cliente_id'],
            'formaDePagamento_id' => $validacao['formaDePagamento_id'],
            'vendedor_id' => auth('web')->user()->vendedor->id,
        ]);

        if (isset($validacao['produtos'])) {
            foreach ($validacao['produtos'] as $item) {
                \DB::table('item_venda')->insert([
                    'produto_id' => $item['produto_id'],
                    'quantidade' => $item['quantidade'],
                    'venda_id' => $venda->id,
                ]);
            }
        }

        if (isset($validacao['parcelas'])) {
            foreach ($validacao['parcelas'] as $parcela) {
                $venda->parcelas()->create([
                    'valor' => $parcela['valor'],
                    'data_vencimento' => $parcela['data_vencimento'],
                ]);
            }
        }

        return redirect()->route('venda')->with('success', 'Venda criada com sucesso!');
    }




    public function create()
    {
        $clientes = Cliente::all();
        $formasDePagamento = FormaDePagamento::all();
        $produtos = Produto::all();

        return view('venda.create', [
            'clientes' => $clientes,
            'formasDePagamento' => $formasDePagamento,
            'produtos' => $produtos,
        ]);
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
