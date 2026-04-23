<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Kaprodi extends Controller
{
    public function lihat_penilaian()
    {
        if (Session::has('session_tahun')) {
            $session_tahun = Session::get('session_tahun');
        } else {
            $session_tahun = '';
        }
        if (Session::has('session_semester')) {
            $session_semester = Session::get('session_semester');
        } else {
            $session_semester = '';
        }
        $session_kode_program_studi = (Session::has('kode_program_studi')) ? Session::get('kode_program_studi') : '';

        $session_tipe = (Session::has('tipe')) ? Session::get('tipe') : '';
        $session_kode_dosen = (Session::has('id_dosen')) ? Session::get('id_dosen') : '';
        $session_kaprodi = (Session::has('kaprodi')) ? Session::get('kaprodi') : '';

        $title = "Lihat Mata Kuliah Prodi";
        $parent_breadcrumb = "Penilaian Mata Kuliah";
        $child_breadcrumb = "";
        return view('Kaprodi/lihat_penilaian/index', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_program_studi', 'session_tipe', 'session_kode_dosen','session_kaprodi'));
    }

    public function skripsi_index()
    {
        $session_kode_program_studi = (Session::has('kode_program_studi')) ? Session::get('kode_program_studi') : '';
        $session_nim = Session::has('username') ? Session::get('username') : '';
        $api_token = Session::has('token') ? Session::get('token') : '';
        $api_url = config('setting.second_url');

        $title = "Manajemen Tugas Akhir";
        $parent_breadcrumb = "Kaprodi";
        $child_breadcrumb = "Skripsi";

        return view('Kaprodi/skripsi/index', compact(
            'title', 'parent_breadcrumb', 'child_breadcrumb',
            'session_kode_program_studi', 'session_nim', 'api_token', 'api_url'
        ));
    }
}