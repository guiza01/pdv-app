<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('cliente', compact('clientes'));
    }

    public function store(Request $request)
    {
        $validacao = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:clientes,cpf',
        ]);

        $cliente = new Cliente();
        $cliente->nome = $validacao['nome'];
        $cliente->cpf = $validacao['cpf'];
        $cliente->save();
        
        return redirect()->route('clientes')->with('success', 'Cliente adicionado com sucesso!');
    }

    public function create()
    {
        return view('cliente.create');
    }

    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('show', compact('cliente'));
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('venda.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $validacao = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:clientes,cpf,' . $id,
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($validacao);

        return redirect()->route('clientes')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes')->with('success', 'Cliente deletado com sucesso!');
    }
}
