<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\OpenAIService;

class Chat extends Component
{
    public $message;
    public $messages = [];

    protected $rules = [
        'message' => 'required|string|max:255',
    ];

    public function sendMessage(OpenAIService $openAIService)
    {
        $this->validate();

        // Enviar a mensagem para a API da OpenAI
        $response = $openAIService->sendMessageToGPT($this->message);

        // Verificar se a resposta contém a mensagem do assistente
        if (strpos($response, 'Erro') === false) {
            // Adicionar a mensagem do usuário e a resposta da IA ao histórico
            $this->messages[] = ['role' => 'user', 'content' => $this->message];
            $this->messages[] = ['role' => 'assistant', 'content' => $response];
        } else {
            // Em caso de erro, adicionar a mensagem de erro ao histórico
            $this->messages[] = ['role' => 'assistant', 'content' => $response];
        }

        // Limpar a mensagem
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
