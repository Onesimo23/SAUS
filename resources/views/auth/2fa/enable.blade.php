@extends('layouts.guest')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg w-full max-w-md p-6">
        <div class="text-center mb-4">
            <h5 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Ativar Autenticação de Dois Fatores</h5>
        </div>
        
        <p class="text-center text-sm text-gray-600 dark:text-gray-400 mb-3">
            Escaneie o QR Code abaixo com seu aplicativo autenticador.
        </p>

        <!-- Mensagem sobre o aplicativo -->
        <p class="text-center text-xs text-gray-600 dark:text-gray-400 mb-3">
            Para isso, baixe o aplicativo Google Authenticator na <strong>Play Store</strong> ou <strong>App Store</strong>.
        </p>

        <!-- Exibição do QR Code -->
        <div class="text-center mb-4">
            <img src="{{ $qrCodeUrl }}" alt="QR Code" class="mx-auto max-w-[150px] mb-4" />
        </div>
        
        <!-- Código manual -->
        <p class="text-center text-sm text-gray-600 dark:text-gray-400 mb-3">
            Ou insira manualmente este código:
        </p>
        <div class="bg-gray-100 text-center p-4 rounded-md mb-4">
            <strong class="text-gray-700 dark:text-gray-300">{{ $secret }}</strong>
        </div>
        
        <!-- Formulário de verificação -->
        <form method="POST" action="{{ route('2fa.store') }}">
            @csrf
            <div class="mb-4">
                <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Digite o código de verificação:</label>
                <input id="code" type="text" name="code" 
                    class="mt-2 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-violet-500 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600"
                    placeholder="Ex.: 123456" required>
                
                @error('code')
                    <div class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="mt-4">
                <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Verificar e Ativar
                </button>
            </div>
            <div class="mt-3 text-center">
                <a href="{{ url()->previous() }}" class="text-muted">
                    {{ __('Cancelar e Voltar') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
