<?php

namespace App\Http\Controllers;

use Gemini\Laravel\Facades\Gemini;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function showChatForm()
    {
        return view('chat.chat');
    }

    public function generateResponse(Request $request)
    {
        $userInput = $request->input('user_input');

        $result = Gemini::geminiPro()->generateContent($userInput);

        $response = $result->text();

        // Return the response as a JSON object
        return response()->json(['response' => $response]);
    }

}
