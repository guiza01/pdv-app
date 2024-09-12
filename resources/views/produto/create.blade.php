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

                    <form action="{{ route('produtos.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nome" class="block text-gray-700">Nome</label>
                            <input type="text" id="nome" name="nome" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="valor" class="block text-gray-700">Valor</label>
                            <input type="number" id="valor" name="valor" class="mt-1 block w-full" step="0.01" required>
                        </div>

                        <div class="mb-4">
                            <label for="descricao" class="block text-gray-700">Descrição</label>
                            <textarea id="descricao" name="descricao" class="mt-1 block w-full" required></textarea>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
                            Adicionar Produto
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
