<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Simpan ke database
class InviteTrainerController extends Controller
{
    // Menampilkan form invite
    public function showForm()
    {
        return view('loginregis.invite'); // Sesuaikan dengan path view-mu
    }

    // Memverifikasi kode invite
    public function verifyCode(Request $request)
    {
        $request->validate([
            'invite_code' => 'required|string',
        ]);

        $validCodes = ['TRAINER123', 'BULKUP2024', 'a']; // Ganti/ambil dari DB kalau perlu

        if (in_array($request->invite_code, $validCodes)) {
            // Simpan ke session untuk dipakai di form registrasi
            session(['is_trainer' => true]);

            return redirect()->route('trainer.register.form')->with('success', 'Invite code is valid! Please complete your profile.');
        }

        return back()->withErrors(['invite_code' => 'Invite code is invalid. Please check again..'])->withInput();
    }
}
