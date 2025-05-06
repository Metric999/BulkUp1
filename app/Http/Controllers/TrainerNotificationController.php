<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainerNotificationController extends Controller
{
    public function index()
    {
        $path = storage_path('app/pengaturan_notif.json');

        // Default pengaturan
        $default = [
            'sarapan' => 'on',
            'waktu_sarapan' => '07:00',
            'makan_siang' => 'on',
            'waktu_makan_siang' => '12:30',
            'tidur' => 'on',
            'waktu_tidur' => '21:00',
        ];

        // Jika file ada, ambil datanya
        $pengaturan = file_exists($path)
            ? json_decode(file_get_contents($path), true)
            : $default;

        return view('trainer.notification', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $data = [
            'sarapan' => $request->has('sarapan') ? 'on' : 'off',
            'waktu_sarapan' => $request->input('waktu_sarapan', ''),
            'makan_siang' => $request->has('makan_siang') ? 'on' : 'off',
            'waktu_makan_siang' => $request->input('waktu_makan_siang', ''),
            'tidur' => $request->has('tidur') ? 'on' : 'off',
            'waktu_tidur' => $request->input('waktu_tidur', ''),
        ];

        file_put_contents(storage_path('app/pengaturan_notif.json'), json_encode($data));

        return redirect()->route('trainer.notification')->with('message', 'Pengaturan berhasil disimpan!');
    }
}
