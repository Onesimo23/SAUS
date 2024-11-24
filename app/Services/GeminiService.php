<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');  // Certifique-se de ter configurado sua chave no .env
    }

    public function sendMessageToGemini($message)
    {
        // URL para a API do Gemini
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $this->apiKey;

        // Corpo da requisição com o formato exigido pela API
        $data = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $message
                        ]
                    ]
                ]
            ]
        ];

        // Realizando a requisição POST com o corpo e cabeçalhos adequados
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url, $data);

        // Verificar se a requisição foi bem-sucedida
        if ($response->successful()) {
            // Exibir a resposta completa para depuração
            return $response->json();  // Retorna a resposta da API para inspeção
        } else {
            // Se a requisição falhar, retorna o erro
            return ['error' => 'Erro ao se comunicar com a API Gemini: ' . $response->status(), 'response' => $response->json()];
        }
    }
}
