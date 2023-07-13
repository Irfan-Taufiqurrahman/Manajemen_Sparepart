<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Twilio\Rest\Client;

class ForgotPasswordController extends Controller
{
    public function resetIndex()
    {
        return view('auth/forgotPassword');
    }

    public function sendResetLink(Request $request)
    {
        //validasi input
        $request->validate([
            'number_phone' => 'required',
        ]);

        //Cek apakah phone_number ada di database
        $user = DB::table('users')->where('phone_number', $request->phone_number)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['phone_number' => 'Nomor Telefon tidak ditemukan']);
        }

        //Generate token reset password
        $token = Password::getRepository()->create($user);

        //kirim link reset password melalui pesan whatsapp
        $this->sendWhatsAppResetLink($user, $token);

        return redirect()->back()->with('success', 'Link reset password telah dikirim melalui Whatsapp');
    }

    private function sendWhatsAppResetLink($user, $token)
    {
        $twilioSid = env('TWILIO_SID');
        $twilioToken = env('TWILIO_AUTH_TOKEN');
        $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');

        $client = new Client($twilioSid, $twilioToken);

        // Remove the '+' sign from the phone number
        $whatsappRecipient = str_replace('+', '', $user->phone_number);

        $whatsappMessage = "Halo " . $user->name . "! Klik link berikut untuk mereset password anda: " . url('password/reset', $token);

        $message = $client->messages->create(
            "whatsapp:" . $twilioPhoneNumber,
            [
                "from" => "whatsapp:" . $twilioPhoneNumber,
                "body" => $whatsappMessage,
                "to" => "whatsapp:" . $whatsappRecipient,
            ]
        );
    }
}
