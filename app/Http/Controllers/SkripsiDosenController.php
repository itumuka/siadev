<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SkripsiDosenController extends Controller
{
    private function getCommonData()
    {
        return [
            'session_tahun' => Session::has('session_tahun') ? Session::get('session_tahun') : '',
            'session_semester' => Session::has('session_semester') ? Session::get('session_semester') : '',
            'session_kode_program_studi' => Session::has('kode_program_studi') ? Session::get('kode_program_studi') : '',
            'session_tipe' => Session::has('tipe') ? Session::get('tipe') : '',
            'session_id_dosen' => Session::has('id_dosen') ? Session::get('id_dosen') : '',
            'api_token' => Session::has('token') ? Session::get('token') : '',
            'session_username' => Session::has('username') ? Session::get('username') : '',
            'api_url' => config('setting.second_url'),
            'parent_breadcrumb' => 'Pembimbing Skripsi'
        ];
    }

    public function index()
    {
        $data = $this->getCommonData();
        $data['title'] = 'Daftar Mahasiswa Bimbingan';
        $data['child_breadcrumb'] = '';
        
        return view('Dosen.skripsi.index', $data);
    }

    public function bimbingan(Request $request, $id_skripsi)
    {
        $data = $this->getCommonData();
        $data['title'] = 'Validasi Log Bimbingan';
        $data['child_breadcrumb'] = 'Log Bimbingan';
        $data['id_skripsi'] = $id_skripsi; // pass to view to fetch specific log
        
        return view('Dosen.skripsi.bimbingan', $data);
    }
}