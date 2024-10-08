<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-white leading-tight">
            {{ __('Adicionar Venda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray dark:text-black-100">
                    <div class="container">
                        <form action="{{ route('venda.create') }}" method="POST">
                            @csrf

                            <!-- Cliente -->
                            <div class="form-group mb-4">
                                <label for="cliente_id" class="block text-sm font-medium text-white">Nome do Cliente</label>
                                <select class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="cliente_id" name="cliente_id">
                                    <option value="">Selecione um cliente</option>
                                    @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Forma de Pagamento -->
                            <div class="form-group mb-4">
                                <label for="formaDePagamento_id" class="block text-sm font-medium text-white">Pagamento</label>
                                <select class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="formaDePagamento_id" name="formaDePagamento_id" required>
                                    <option value="">Forma de pagamento</option>
                                    @foreach($formasDePagamento as $forma)
                                    <option value="{{ $forma->id }}">{{ $forma->descricao }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Campo para selecionar parcelas (oculto inicialmente) -->
                            <div id="parcelas_section" class="form-group mb-4" style="display:none;">
                                <label for="num_parcelas" class="block text-sm font-medium text-white ">Número de Parcelas</label>
                                <input type="number" id="num_parcelas" name="num_parcelas" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm" min="1">
                            </div>

                            <!-- Produtos -->
                            <div class="form-group mb-4">
                                <label for="produtos" class="block text-sm font-medium text-white ">Produtos</label>
                                <div id="produtos-container" class="mt-1"></div>
                                <button type="button" onclick="addProduct()" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 mt-2">Adicionar Produto</button>
                            </div>

                            <!-- Valor Total -->
                            <div class="form-group mb-4">
                                <label for="valor_total" class="block text-sm font-medium text-white ">Valor Total</label>
                                <input type="text" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="valor_total" name="valor_total" value="{{ old('valor_total') }}" readonly>
                            </div>

                            <!-- Exibir parcelas e suas datas -->
                            <div id="parcelas_datas_section"></div>

                            <!-- Exibir erros -->
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

                            <!-- Submeter -->
                            <button type="submit" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Finalizar</button>
                        </form>
                    </div>

                    <!-- Scripts -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const today = new Date().toISOString().split('T')[0];
                            document.getElementById('data_pagamento').value = today;
                        });

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

                        // Novo script para controlar a exibição e o cálculo das parcelas
                        document.getElementById('formaDePagamento_id').addEventListener('change', function() {
                            const formaPagamento = this.value;
                            const parcelasSection = document.getElementById('parcelas_section');
                            
                            if (formaPagamento === '2') {  // Supondo que '2' seja o ID da forma de pagamento "Crédito"
                                parcelasSection.style.display = 'block';
                            } else {
                                parcelasSection.style.display = 'none';
                                document.getElementById('parcelas_datas_section').innerHTML = '';
                            }
                        });

                        document.getElementById('num_parcelas').addEventListener('input', function() {
                            const numParcelas = parseInt(this.value);
                            const valorTotal = parseFloat(document.getElementById('valor_total').value);
                            const parcelasSection = document.getElementById('parcelas_datas_section');
                            const today = new Date();

                            if (!isNaN(numParcelas) && numParcelas > 0 && valorTotal > 0) {
                                let valorParcela = (valorTotal / numParcelas).toFixed(2);
                                parcelasSection.innerHTML = '';

                                for (let i = 1; i <= numParcelas; i++) {
                                    let dataParcela = new Date(today);
                                    dataParcela.setDate(dataParcela.getDate() + (30 * (i - 1)));

                                    parcelasSection.innerHTML += `
                                        <div class="form-group">
                                            <label class="block text-sm font-medium text-white">Parcela ${i}: R$ ${valorParcela} - Data: </label>
                                            <input type="date" name="data_parcela_${i}" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="${dataParcela.toISOString().substring(0, 10)}" readonly />
                                        </div>
                                    `;
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
