<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'required|email|max:255|unique:newsletters,email',
        ]);

        // Adiciona o código de país +258 ao número de WhatsApp, se não estiver presente
        $whatsapp = $request->whatsapp;
        if ($whatsapp && strpos($whatsapp, '+258') !== 0) {
            $whatsapp = '+258' . $whatsapp;
        }

        // Salva os dados no banco de dados
        Newsletter::create([
            'name' => $request->name,
            'whatsapp' => $whatsapp,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Inscrição realizada com sucesso!');
    }

}
