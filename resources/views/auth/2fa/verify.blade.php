@extends('layouts.guest')

@section('content')
<div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded shadow p-6">
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4 text-center">
        Verificação de Dois Fatores
    </h2>

    <!-- Exibição de erros -->
    @if ($errors->any())
        <div class="mb-4 text-red-600 dark:text-red-400">
            @foreach ($errors->all() as $error)
                <p class="text-sm">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <!-- Exibição de mensagem de sucesso -->
    @if (session('success'))
        <div class="mb-4 text-green-600 dark:text-green-400">
            <p class="text-sm">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Formulário -->
    <form method="POST" action="{{ route('2fa.validate') }}" class="space-y-4">
        @csrf
        <div>
            <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Digite o código de verificação:
            </label>
            <input id="code" type="text" name="code" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600"
                   placeholder="Ex.: 123456" required>
        </div>
        
        <div>
            <button type="submit" class="w-full bg-violet-500 text-white py-2 px-4 rounded hover:bg-violet-600 focus:outline-none focus:ring-2 focus:ring-violet-400">
                Verificar
            </button>
        </div>
        <div class="mt-3 text-center">
                <a href="{{ url()->previous() }}" class="text-muted">
                    {{ __('Cancelar e Voltar') }}
                </a>
            </div>
    </form>
</div>
@endsection
