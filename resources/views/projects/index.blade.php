@extends('layouts.guest')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Gerenciamento de Projetos</h1>

        <!-- Botão para criar novo projeto -->
        <div class="mb-4">
            <a href="{{ route('projects.create') }}">
                <x-button class="bg-blue-500 hover:bg-blue-600">
                    Criar Projeto
                </x-button>
            </a>
        </div>

        <!-- Lista de projetos -->
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table id="projectsTable" class="display w-full">
                <thead>
                    <tr>
                        <th>Nome do Projeto</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->description }}</td>
                            <td class="flex space-x-2">
                                <a href="{{ route('projects.edit', $project->id) }}">
                                    <x-button class="bg-yellow-500 hover:bg-yellow-600">
                                        Editar
                                    </x-button>
                                </a>
                                <a href="{{ route('projects.manageUsers', $project->id) }}">
                                    <x-button class="bg-green-500 hover:bg-green-600">
                                        Gerenciar Usuários
                                    </x-button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
