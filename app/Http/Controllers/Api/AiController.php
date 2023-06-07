<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Orhanerday\OpenAi\OpenAi;
use Aws\Textract\TextractClient;
use Aws\Textract\Exception\TextractException;


class AiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function upload(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'image' => 'required|file|mimes:jpg,png,webp'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }


        $file = $req->file('image');

        $textractClient = new TextractClient([
            'version' => 'latest',
            'region' => env('AWS_REGION'),
            'credentials' => [
                'key'    => env('AWS_KEY'),
                'secret' => env('AWS_SECRET')
            ],
            'scheme' => 'https',
        ]);


        try {
            $result = $textractClient->detectDocumentText([
                'Document' => [
                    'Bytes' => file_get_contents($file->getRealPath())
                ]
            ]);

            $words = "";
            foreach ($result->get('Blocks') as $block) {
                if ($block['BlockType'] != 'WORD') {
                    continue;
                }

                $words = $words . $block['Text'] . " ";
            }
        } catch (TextractException $e) {
            // output error message if fails
            return response()->json(['error' => $e->getMessage()]);
        }

        $openaikey = env('OPENAI_API_KEY');

        $open_ai = new OpenAi($openaikey);

        $chat =   $open_ai->chat([
            'model' => 'gpt-3.5-turbo',
            'messages' => [

                [
                    "role" => "user",
                    "content" => "Explain this code '$words' "
                ],
            ],

        ]);

        $d = json_decode($chat);

        $r = $d->choices[0]->message->content;

        return response()->json(['data' => $r], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
