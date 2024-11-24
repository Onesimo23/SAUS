<x-app-layout>
    <h1 class="text-lg font-bold mb-4">Configuração de Autenticação de Dois Fatores</h1>

    @if (session('status'))
        <div class="mb-4 text-green-600">{{ session('status') }}</div>
    @endif

    <div>
        <p>Use o aplicativo autenticador para escanear este QR Code:</p>
        <img src="{{ $qrCodeUrl }}" alt="QR Code">

        <p class="mt-4">Ou insira este código manualmente: <strong>{{ $secret }}</strong></p>
    </div>

    <form method="POST" action="{{ route('two-factor.enable') }}">
        @csrf
        <button type="submit" class="btn btn-primary mt-4">Ativar</button>
    </form>
</x-app-layout>
