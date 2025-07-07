<?php
namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;

class TicketClassifier
{
    /**
     * Classify a ticket using OpenAI.
     *
     * @param string $subject
     * @param string $message
     * @return array
     */
    public static function classify(string $subject, string $message): array
    {
        try{
            $isEnabled = (bool)env('OPENAI_CLASSIFY_ENABLED');
            if(!$isEnabled){
                throw new \Exception('OpenAI classification is not enabled');
            }

            $prompt = <<<EOT
            Given the following ticket information, categorize the ticket, explain your reasoning, and provide a confidence score (0 to 1).

            Subject: {$subject}
            Body: {$message}

            Respond in JSON with keys: category, explanation, confidence.
            EOT;

            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'temperature' => 0.2,
            ]);

            // Extract the content from the response
            $content = $response->choices[0]->message->content;

            Log::info('OpenAI response: ' . $content);

            // Attempt to decode the JSON result
            $result = json_decode($content, true);

            return $result;
        } catch (\Exception $e) {
            Log::error('Error classifying ticket: ' . $e->getMessage());
            throw $e;
        }
    }
}

