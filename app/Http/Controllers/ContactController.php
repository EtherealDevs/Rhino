<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'floating_email' => 'required|email',
            'floating_first_name' => 'required|string',
            'floating_last_name' => 'required|string',
            'floating_message' => 'required|string',
        ]);

        // Recopilar datos del formulario
        $data = [
            'email' => $request->floating_email,
            'first_name' => $request->floating_first_name,
            'last_name' => $request->floating_last_name,
            'message' => $request->floating_message,
        ];

        // Enviar el correo electrónico
        Mail::to('correo@destino.com')->send(new ContactFormMail($data));

        return back()->with('success', '¡Tu mensaje ha sido enviado!');
    }
}
