<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-center text-gray-800">
            {{ __('Verificação de Dois Fatores') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600 text-center">
            {{ __('Digite o código gerado pelo seu aplicativo autenticador.') }}
        </p>

        <form method="POST" action="{{ route('2fa.validate') }}" class="mt-6">
            @csrf

            <div class="mb-4">
                <label for="code" class="block text-sm font-medium text-gray-700">
                    {{ __('Código de Verificação') }}
                </label>
                <input id="code" 
                       type="text" 
                       name="code" 
                       class="w-full px-4 py-2 mt-1 text-sm border rounded-md shadow-sm focus:ring focus:ring-indigo-300 focus:outline-none 
                       @error('code') border-red-500 @enderror" 
                       required autocomplete="off" autofocus>
                
                @error('code')
                    <span class="text-sm text-red-600">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit" 
                        class="w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-300">
                    {{ __('Verificar') }}
                </button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ url()->previous() }}" class="text-sm text-gray-500 hover:underline">
                {{ __('Voltar') }}
            </a>
        </div>
    </div>
</div>
