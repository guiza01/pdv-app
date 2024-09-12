<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Adicionar Produto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-black-100">

                <form action="{{ route('venda.create') }}" method="GET">
                        @csrf

                        <div class="mb-4">
                            <label for="cliente_id" class="block text-gray-700">Cliente</label>
                            <select id="cliente_id" name="cliente_id" class="mt-1 block w-full">
                                <option value="">Selecione o cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="formaDePagamento_id" class="block text-gray-700">Forma de Pagamento</label>
                            <select id="formaDePagamento_id" name="formaDePagamento_id" class="mt-1 block w-full">
                                <option value="">Selecione a forma de pagamento</option>
                                @foreach ($formasDePagamento as $forma)
                                    <option value="{{ $forma->id }}">{{ $forma->descricao }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="data_pagamento" class="block text-gray-700">Data do Pagamento</label>
                            <input type="date" id="data_pagamento" name="data_pagamento" class="mt-1 block w-full" required>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
                            Finalizar Venda
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
