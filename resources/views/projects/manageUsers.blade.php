@extends('layouts.guest')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Gerenciar Usuários</h1>

        <!-- Formulário para adicionar usuário -->
        <form action="{{ route('projects.addUser', $project->id) }}" method="POST" class="mb-6">
            @csrf
            <div class="flex space-x-2">
                <!-- Select de Usuários cadastrados -->
                <div>
                    <x-label for="email" value="Email do Usuário" />
                    <select id="email" name="email" required class="block w-full mt-1 rounded-md shadow-sm border-gray-300">
                        <option value="">Selecione um Usuário</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->email }}">{{ $user->email }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Select para definir o role -->
                <div>
                    <x-label for="role" value="Papel" />
                    <select id="role" name="role" required class="block w-full mt-1 rounded-md shadow-sm border-gray-300">
                        <option value="admin">Administrador</option>
                        <option value="editor">Editor</option>
                        <option value="viewer">Visualizador</option>
                    </select>
                </div>

                <x-button type="submit" class="bg-green-500 hover:bg-green-600">Adicionar</x-button>
            </div>
        </form>

        <!-- Lista de usuários no projeto -->
        <div class="space-y-4">
            <h3 class="text-lg font-medium text-gray-700">Usuários do Projeto</h3>
            <ul class="list-disc pl-6">
                @foreach ($project->users as $user)
                    <li>{{ $user->email }} - {{ ucfirst($user->pivot->role) }}</li>
                @endforeach
            </ul>
        </div>

        <div class="mt-4 flex justify-end">
            <x-button @click="window.history.back()" class="bg-gray-500 hover:bg-gray-600">Fechar</x-button>
        </div>
    </div>
@endsection
