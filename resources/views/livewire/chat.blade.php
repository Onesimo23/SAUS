<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <div class="space-y-4">
        <!-- Exibe as mensagens -->
        <div>
            @foreach ($messages as $msg)
                <!-- Verifica o papel da mensagem e a alinha à direita ou à esquerda -->
                <div class="{{ $msg['role'] === 'user' ? 'text-right' : 'text-left' }}">
                    <div class="inline-block rounded-lg px-4 py-2 {{ $msg['role'] === 'user' ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-800' }}">
                        {{ $msg['content'] }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Campo de entrada e botão de envio -->
        <div class="flex space-x-2">
            <input type="text" wire:model="message" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Digite sua mensagem..." />
            <button wire:click="sendMessage" class="px-4 py-2 bg-blue-500 text-white rounded-md">Enviar</button>
        </div>
    </div>
</div>
