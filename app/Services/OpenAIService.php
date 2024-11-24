<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
    }

    public function sendMessageToGPT($message)
    {
        $maxRetries = 5; // Número máximo de tentativas
        $retryCount = 0;

        while ($retryCount < $maxRetries) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo', // Ou 'gpt-4' se você tem acesso
                'messages' => [
                    ['role' => 'user', 'content' => $message]
                ],
                'max_tokens' => 150
            ]);

            // Verificar se a resposta foi bem-sucedida
            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['choices'][0]['message']['content'])) {
                    return $data['choices'][0]['message']['content'];
                } else {
                    return 'Erro: Resposta não contém a chave "choices" esperada.';
                }
            }

            // Se o erro for 429, aguarde antes de tentar novamente
            if ($response->status() == 429) {
                $retryAfter = $response->header('Retry-After') ?? 30; // Padrão 30 segundos
                $retryAfter = intval($retryAfter); // Garantir que seja um número inteiro
                Log::info("Limite de requisições atingido. Tentando novamente em {$retryAfter} segundos.");
                sleep($retryAfter); // Aguardar o tempo de retry
            } else {
                return 'Erro ao se comunicar com a API do OpenAI: ' . $response->status();
            }

            $retryCount++;
        }

        return 'Número máximo de tentativas atingido.';
    }
}
