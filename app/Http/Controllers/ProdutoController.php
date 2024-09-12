<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('produto', compact('produtos'));
    }

    public function store(Request $request)
    {
        $validacao = $request->validate([
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'descricao' => 'required|string|max:1000',
        ]);

        $produto = new Produto();
        $produto->nome = $validacao['nome'];
        $produto->valor = $validacao['valor'];
        $produto->descricao = $validacao['descricao'];
        $produto->save();
        
        return redirect()->route('produtos')->with('success', 'Produto adicionado com sucesso!');
    }

    public function create()
    {
        return view('produto.create');
    }

    public function show($id)
    {
        $produto = Produto::findOrFail($id);
        return view('show', compact('produto')); // Atualize para uma view 'show' se necessário
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produto.edit', compact('produto')); // Certifique-se de que há uma view 'edit'
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

        return redirect()->route('produtos')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return redirect()->route('produtos')->with('success', 'Produto deletado com sucesso!');
    }
}
