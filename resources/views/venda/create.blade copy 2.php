<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Adicionar Venda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-black-100">
                    <form action="{{ route('venda.store') }}" method="POST">
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
                            <label for="itens" class="block text-gray-700">Itens</label>
                            <div id="itens-container">
                                <div class="item mb-4">
                                    <select name="itens[0][produto_id]" class="mt-1 block w-full">
                                        <option value="">Selecione o produto</option>
                                        @foreach ($produtos as $produto)
                                        <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="itens[0][quantidade]" class="mt-1 block w-full" placeholder="Quantidade" min="1">
                                </div>
                            </div>
                            <button type="button" onclick="addItem()" class="bg-green-500 text-white py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
                                Adicionar Item
                            </button>
                        </div>

                        <div class="mb-4">
                            <label for="parcelas" class="block text-gray-700">Parcelas</label>
                            <div id="parcelas-container">
                                <div class="parcela mb-4">
                                    <input type="number" name="parcelas[0][valor]" class="mt-1 block w-full" placeholder="Valor" min="0">
                                    <input type="date" name="parcelas[0][data_vencimento]" class="mt-1 block w-full">
                                </div>
                            </div>
                            <button type="button" onclick="addParcela()" class="bg-green-500 text-white py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
                                Adicionar Parcela
                            </button>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
                            Finalizar Venda
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let itemIndex = 1;
        let parcelaIndex = 1;

        function addItem() {
            const container = document.getElementById('itens-container');
            const newItem = document.createElement('div');
            newItem.classList.add('item', 'mb-4');
            newItem.innerHTML = `
                <select name="itens[${itemIndex}][produto_id]" class="mt-1 block w-full">
                    <option value="">Selecione o produto</option>
                    @foreach ($produtos as $produto)
                        <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                    @endforeach
                </select>
                <input type="number" name="itens[${itemIndex}][quantidade]" class="mt-1 block w-full" placeholder="Quantidade" min="1">
            `;
            container.appendChild(newItem);
            itemIndex++;
        }

        function addParcela() {
            const container = document.getElementById('parcelas-container');
            const newParcela = document.createElement('div');
            newParcela.classList.add('parcela', 'mb-4');
            newParcela.innerHTML = `
                <input type="number" name="parcelas[${parcelaIndex}][valor]" class="mt-1 block w-full" placeholder="Valor" min="0">
                <input type="date" name="parcelas[${parcelaIndex}][data_vencimento]" class="mt-1 block w-full">
            `;
            container.appendChild(newParcela);
            parcelaIndex++;
        }
    </script>
</x-app-layout>