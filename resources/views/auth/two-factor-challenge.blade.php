<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        Por favor, insira o código gerado no seu aplicativo autenticador para verificar o login.
    </div>

    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf

        <div>
            <label for="code" class="block font-medium text-sm text-gray-700">
                Código
            </label>
            <input id="code" type="text" name="code" class="block mt-1 w-full" autofocus required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="btn btn-primary">
                Verificar
            </button>
        </div>
    </form>
</x-guest-layout>
