<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function handle(Request $request)
    {
        $message = $request->input('message');

        if (!$message) {
            return response()->json(['response' => 'Üres üzenetet nem tudok feldolgozni.']);
        }

        $apiKey = env('GROQ_API_KEY');

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.1-8b-instant', // Ingyenes, megbízható modell
                'messages' => [
                    ['role' => 'system', 'content' => 'Te egy segítőkész asszisztens vagy az álláskereső portálhoz, magyarul válaszolsz.'],
                    ['role' => 'user', 'content' => $message],
                ],
                'max_tokens' => 500,
                'temperature' => 0.7,
            ]);

            if ($response->failed()) {
                Log::error('Groq API hiba: ' . $response->body());
                return response()->json(['response' => 'Hiba történt a chatbot működése közben.']);
            }

            $data = $response->json();
            $reply = $data['choices'][0]['message']['content'] ?? 'Nem érkezett válasz.';

        } catch (\Exception $e) {
            Log::error('Groq API kivétel: ' . $e->getMessage());
            $reply = 'Nem tudtam kapcsolatba lépni az AI szerverrel.';
        }

        return response()->json(['response' => $reply]);
    }
}