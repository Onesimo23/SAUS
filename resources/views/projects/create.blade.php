@extends('layouts.guest')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Criar Projeto</h1>

        <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <x-label for="name" value="Nome do Projeto" />
                    <x-input id="name" type="text" name="name" required />
                </div>
                <div>
                    <x-label for="description" value="Descrição" />
                    <x-input id="description" type="text" name="description" required />
                </div>
            </div>

            <div class="mt-4 flex justify-end space-x-4">
                <x-button @click="window.history.back()" class="bg-gray-500 hover:bg-gray-600">Cancelar</x-button>
                <x-button type="submit" class="bg-blue-500 hover:bg-blue-600">Salvar</x-button>
            </div>
        </form>
    </div>
@endsection
