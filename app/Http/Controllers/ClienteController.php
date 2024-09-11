<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    public function store(Request $request)
    {
        $validacao = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:clientes,cpf',
        ]);

        $cliente = Cliente::create($validacao);

        return response()->json($cliente, 201);
    }

    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);

        return response()->json($cliente);
    }

    public function update(Request $request, $id)
    {
        $validacao = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:clientes,cpf,' . $id,
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($validacao);

        return response()->json($cliente);
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return response()->json(['message' => 'Cliente deletado com sucesso.']);
    }
}
