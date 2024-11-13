<?php

namespace App\Services;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function sendMessage($to, $message)
    {
        try {
            $this->client->messages->create(
                'whatsapp:' . $to,
                [
                    'from' => env('TWILIO_WHATSAPP_NUMBER'),
                    'body' => $message
                ]
            );
            return true;
        } catch (\Exception $e) {
            Log::error('Erro ao enviar mensagem no WhatsApp: ' . $e->getMessage());
            return false;
        }
    }
}
