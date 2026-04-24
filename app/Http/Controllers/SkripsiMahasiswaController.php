<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class SkripsiMahasiswaController extends Controller
{
    private function getCommonData()
    {
        return [
            'session_nim' => Session::has('username') ? Session::get('username') : '',
            'api_token'   => Session::has('token') ? Session::get('token') : '',
        ];
    }

    public function index()
    {
        $data = $this->getCommonData();
        $data['title'] = 'Dashboard Skripsi';
        $data['api_url'] = config('setting.second_url');
        return view('Mahasiswa.skripsi.dashboard', $data);
    }

    public function seminar()
    {
        $data = $this->getCommonData();
        $data['title'] = 'Seminar Proposal';
        // Kirim session_nim dan api_url ke view untuk kebutuhan AJAX
        $data['nim'] = $data['session_nim'];
        $data['api_url'] = config('setting.second_url');
        return view('Mahasiswa.skripsi.seminar', $data);
    }

    public function bimbingan()
    {
        $data = $this->getCommonData();
        $data['title'] = 'Log Bimbingan Skripsi';
        $data['nim'] = $data['session_nim'];
        $data['api_url'] = config('setting.second_url');
        return view('Mahasiswa.skripsi.bimbingan', $data);
    }

    public function ujian()
    {
        $data = $this->getCommonData();
        $data['title'] = 'Ujian Skripsi Pendadaran';
        return view('Mahasiswa.skripsi.ujian', $data);
    }
}
