<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-black-100">

                    <form action="{{ route('clientes.create') }}" method="GET">
                        @csrf
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
                            Adicionar Cliente
                        </button>
                    </form>

                    <table class="min-w-full bg-white mt-6">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b-2 border-black-300">ID</th>
                                <th class="py-2 px-4 border-b-2 border-black-300">Nome</th>
                                <th class="py-2 px-4 border-b-2 border-black-300">CPF</th>
                                <th class="py-2 px-4 border-b-2 border-black-300">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientes as $cliente)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $cliente->id }}</td>
                                <td class="py-2 px-4 border-b">{{ $cliente->nome }}</td>
                                <td class="py-2 px-4 border-b">{{ $cliente->cpf }}</td>
                                <td class="py-2 px-4 border-b flex space-x-2">
                                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="bg-green-500 text-black py-1 px-3 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">Editar</a>
                                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-black py-1 px-3 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>