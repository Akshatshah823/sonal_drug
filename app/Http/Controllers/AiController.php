<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class AICONTROLLER extends Controller
{
    public function ask(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:1000'
        ]);

        try {
            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $request->question]
                ],
                'temperature' => 0.7,
                'max_tokens' => 500,
            ]);

            return response()->json([
                'response' => $response->choices[0]->message->content
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
