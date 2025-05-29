<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $data = $request->only('name', 'email', 'subject', 'message');

        // Email tujuanmu (kamu ganti dengan emailmu sendiri)
        $recipientEmail = 's160722030@student.ubaya.ac.id';

        // Kirim email menggunakan Mailable (buat class ContactMail)
        Mail::to($recipientEmail)->send(new \App\Mail\ContactMail($data));

        return back()->with('success', 'Pesan berhasil dikirim. Terima kasih sudah menghubungi kami!');
    }

}
