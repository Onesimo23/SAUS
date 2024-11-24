<?php
namespace App\Livewire;

use Livewire\Component;
use App\Services\GeminiService;

class Chat extends Component
{
    public $message;
    public $messages = [];

    protected $rules = [
        'message' => 'required|string|max:255',
    ];

    public function sendMessage(GeminiService $geminiService)
    {
        $this->validate();
    
        // Adicionar a mensagem do usuário ao histórico de mensagens
        $this->messages[] = ['role' => 'user', 'content' => $this->message];
    
        // Enviar a mensagem para a API do Gemini
        $response = $geminiService->sendMessageToGemini($this->message);
    
        // Verificar se a resposta contém um erro
        if (isset($response['error'])) {
            // Adicionar erro ao histórico de mensagens
            $this->messages[] = ['role' => 'assistant', 'content' => $response['error']];
        } else {
            // Verificar se a estrutura contém a chave "candidates" e "content"
            if (isset($response['candidates'][0]['content']['parts'][0]['text'])) {
                // Adicionar a resposta da API ao histórico de mensagens
                $this->messages[] = ['role' => 'assistant', 'content' => $response['candidates'][0]['content']['parts'][0]['text']];
            } else {
                // Caso não encontre a resposta válida, exibe uma mensagem de erro
                $this->messages[] = ['role' => 'assistant', 'content' => 'Não foi possível obter uma resposta válida da API Gemini.'];
            }
        }
    
        // Limpar a mensagem
        $this->message = '';
    }
    
    public function render()
    {
        return view('livewire.chat', [
            'messages' => $this->messages  // Passa as mensagens para a view
        ]);
    }
    
}
