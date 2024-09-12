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
                    <div class="container">
                        <form action="{{ route('venda.create') }}" method="POST">
                            @csrf

                            <div class="form-group mb-4">
                                <label for="cliente_id" class="block text-sm font-medium text-gray-700">Nome do Cliente</label>
                                <select class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="cliente_id" name="cliente_id">
                                    <option value="">Selecione um cliente</option>
                                    @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label for="forma_pagamento" class="block text-sm font-medium text-gray-700">Pagamento</label>
                                <select class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="forma_pagamento" name="forma_pagamento" required>
                                    <option value="">Forma de pagamento</option>
                                    @foreach($formasDePagamento as $forma)
                                    <option value="{{ $forma->id }}">{{ $forma->descricao }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label for="produtos" class="block text-sm font-medium text-gray-700">Produtos</label>
                                <div id="produtos-container" class="mt-1">
                                </div>
                                <button type="button" onclick="addProduct()" class="btn btn-secondary mt-2">Adicionar Produto</button>
                            </div>

                            <div class="form-group mb-4">
                                <label for="data_pagamento" class="block text-sm font-medium text-gray-700">Data de Pagamento</label>
                                <input type="date" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="data_pagamento" name="data_pagamento" value="{{ old('data_pagamento') }}" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="valor_total" class="block text-sm font-medium text-gray-700">Valor Total</label>
                                <input type="text" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="valor_total" name="valor_total" value="{{ old('valor_total') }}" readonly>
                            </div>
                            
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <input type="hidden" id="produtos-selecionados" name="produtos-selecionados">

                            <button type="submit" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Finalizar</button>
                        </form>
                    </div>

                    <script>
                        let produtoIndex = 1;

                        function addProduct() {
                            const container = document.getElementById('produtos-container');
                            const newProduct = document.createElement('div');
                            newProduct.classList.add('product', 'mb-4');
                            newProduct.innerHTML = `
                                <div class="flex items-center mb-2">
                                    <select name="produtos[${produtoIndex}][id]" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm" onchange="updateValue(${produtoIndex})">
                                        <option value="">Selecione um produto</option>
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto->id }}" data-valor="{{ $produto->valor }}">{{ $produto->nome }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="produtos[${produtoIndex}][quantidade]" class="ml-2 form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Quantidade" min="1" oninput="calculateTotal()">
                                    <input type="text" name="produtos[${produtoIndex}][valor]" class="ml-2 form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm" readonly>
                                </div>
                            `;
                            container.appendChild(newProduct);
                            produtoIndex++;
                        }
                        addProduct();

                        function updateValue(index) {
                            const select = document.querySelector(`select[name="produtos[${index}][id]"]`);
                            const valorInput = document.querySelector(`input[name="produtos[${index}][valor]"]`);
                            const selectedOption = select.options[select.selectedIndex];
                            const valor = selectedOption.getAttribute('data-valor') || 0;
                            valorInput.value = valor;
                            calculateTotal();
                        }

                        function calculateTotal() {
                            let total = 0;
                            document.querySelectorAll('#produtos-container .product').forEach((product) => {
                                const valor = parseFloat(product.querySelector('input[name$="[valor]"]').value) || 0;
                                const quantidade = parseFloat(product.querySelector('input[name$="[quantidade]"]').value) || 0;
                                total += valor * quantidade;
                            });

                            document.getElementById('valor_total').value = total.toFixed(2);
                            updateSelectedProducts();
                        }

                        function updateSelectedProducts() {
                            const selecionados = Array.from(document.querySelectorAll('#produtos-container select')).map(select => select.value).filter(value => value);
                            document.getElementById('produtos-selecionados').value = selecionados.join(',');
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
