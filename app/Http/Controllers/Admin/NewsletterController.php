<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewsletterMail;
use App\Models\Newsletter;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function showWhatsapp()
    {
        $contacts = Newsletter::whereNotNull('whatsapp')->select('name', 'whatsapp')->get(5);
        $count = $contacts->count();

        return view('admin.newsletters.whatsapp', compact('contacts', 'count'));
    }

    protected $whatsAppService;

    public function __construct(WhatsAppService $whatsAppService)
    {
        $this->whatsAppService = $whatsAppService;
    }


    public function sendWhatsapp(Request $request){
        $request->validate(['message' => 'required|string']);
    
        $contacts = Newsletter::whereNotNull('whatsapp')->pluck('whatsapp');
    
        foreach ($contacts as $number) {
            try {
                Log::info("Enviando mensagem para: $number"); // Log antes do envio
                $this->whatsAppService->sendMessage($number, $request->message);
                Log::info("Mensagem enviada para: $number");
            } catch (\Exception $e) {
                Log::error("Erro ao enviar mensagem para $number: " . $e->getMessage());
            }
        }
    
        return back()->with('success', 'Newsletter enviada com sucesso pelo WhatsApp!');
    }
    

    public function showEmail()
    {
        $emails = Newsletter::whereNotNull('email')->pluck('email');
        $count = $emails->count();

        return view('admin.newsletters.email', compact('emails', 'count'));
    }

    public function sendEmail(Request $request)
    {
        $request->validate(['message' => 'required|string', 'image' => 'nullable|image|max:30240']);

         foreach (Newsletter::whereNotNull('email')->pluck('email') as $email) {
            try {
                $mailData = [
                    'message' => $request->message,
                ];
    
                // Verifica se uma imagem foi carregada
                if ($request->hasFile('image')) {
                    $imagePath = $request->file('image')->store('newsletters', 'public');
                    $mailData['image'] = $imagePath;
                }
    
                // Envia o e-mail com ou sem imagem
                Mail::to($email)->send(new NewsletterMail($mailData));
    
            } catch (\Exception $e) {
                Log::error('Erro ao enviar newsletter para ' . $email . ': ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Newsletter enviada com sucesso por e-mail!');
    }
}
