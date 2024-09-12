<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __(key: 'Vendas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-black-100">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b-2 border-black-300">ID</th>
                                <th class="py-2 px-4 border-b-2 border-black-300">Cliente</th>
                                <th class="py-2 px-4 border-b-2 border-black-300">Forma de Pagamento</th>
                                <th class="py-2 px-4 border-b-2 border-black-300">Data do Pagamento</th>
                                <th class="py-2 px-4 border-b-2 border-black-300">Vendedor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vendas as $venda)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $venda->id }}</td>
                                <td class="py-2 px-4 border-b">{{ $venda->cliente_id }}</td>
                                <td class="py-2 px-4 border-b">{{ $venda->formaDePagamento_id }}</td>
                                <td class="py-2 px-4 border-b">{{ $venda->dataPagamento }}</td>
                                <td class="py-2 px-4 border-b">{{ $venda->vendedor_id }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>