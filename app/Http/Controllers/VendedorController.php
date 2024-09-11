<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendedorController extends Controller
{
    public function index()
    {
        $vendedores = Vendedor::all();
        return response()->json($vendedores);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:vendedores,cpf',
        ]);

        $vendedor = Vendedor::create($validated);

        return response()->json($vendedor, 201); 
    }

}
