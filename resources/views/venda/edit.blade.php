<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Produto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-black-100">

                    <form action="{{ route('venda.update', $venda->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="cliente" class="block text-gray-700 dark:text-gray-300">Cliente</label>
                            <input type="text" id="cliente" name="cliente" value="{{ old('cliente', $venda->cliente_id) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                            @error('nome')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="formaDePagamento_id" class="block text-gray-700 dark:text-gray-300">Forma de pagamento</label>
                            <input type="text" id="formaDePagamento_id" name="formaDePagamento_id" value="{{ old('formaDePagamento_id', default: $venda->formaDePagamento_id) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                            @error('nome')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="dataPagamento" class="block text-gray-700 dark:text-gray-300">Data do pagamento</label>
                            <textarea id="dataPagamento" name="dataPagamento" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>{{ old('dataPagamento', $venda->dataDoPagamento) }}</textarea>
                            @error('descricao')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="vendedor" class="block text-gray-700 dark:text-gray-300">Vendedor</label>
                            <input type="text" id="vendedor" name="vendedor" value="{{ old('vendedor', $venda->vendedor_id) }}" step="0.01" min="0" class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                            @error('valor')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
                                Atualizar Venda
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
