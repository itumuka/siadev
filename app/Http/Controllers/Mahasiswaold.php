<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Mahasiswa extends Controller
{
    //
    public function check_session(Request $request)
    {
        if (Session::has('username')) {
            $check_session = Session::get('username');
        } else {
            $check_session = 'Tidak ada data dalam session.';
        }

        return $check_session;
    }

    public function khs(Request $request)
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
        if (Session::has('session_nama_tahunakademik')) {
            $session_nama_tahunakademik = Session::get('session_nama_tahunakademik');
        } else {
            $session_nama_tahunakademik = '';
        }

        $session_nim = (Session::has('username')) ? Session::get('username') : '';
        $session_kode_prodi = (Session::has('kode_program_studi')) ? Session::get('kode_program_studi') : '';
        $session_kode_nilai = (Session::has('kode_penilaian')) ? Session::get('kode_penilaian') : '';

        $title = "Kartu Hasil Studi";
        $parent_breadcrumb = "KHS";
        // $child_breadcrumb = "Matakuliah Prasyarat";
        return view('Mahasiswa/khs/khs', compact('title', 'parent_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik', 'session_nim', 'session_kode_prodi','session_kode_nilai'));
    }

    public function jadwalkuliah(Request $request)
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
        if (Session::has('session_nama_tahunakademik')) {
            $session_nama_tahunakademik = Session::get('session_nama_tahunakademik');
        } else {
            $session_nama_tahunakademik = '';
        }

        $title = "Jadwal Kuliah";
        $parent_breadcrumb = "Jadwal kuliah";
        // $child_breadcrumb = "Matakuliah Prasyarat";
        return view('Mahasiswa/jadwalkuliah/jadwalkuliah', compact('title', 'parent_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik'));
    }


    public function presensikuliah(Request $request)
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
        if (Session::has('session_nama_tahunakademik')) {
            $session_nama_tahunakademik = Session::get('session_nama_tahunakademik');
        } else {
            $session_nama_tahunakademik = '';
        }
        $session_nim = (Session::has('username')) ? Session::get('username') : '';

        $title = "Presensi Kuliah";
        $parent_breadcrumb = "Presensi Kuliah";
        // $child_breadcrumb = "Matakuliah Prasyarat";
        return view('Mahasiswa/presensikuliah/presensikuliah', compact('title', 'parent_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik', 'session_nim'));
    }

    public function krs(Request $request)
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
        if (Session::has('session_nama_tahunakademik')) {
            $session_nama_tahunakademik = Session::get('session_nama_tahunakademik');
        } else {
            $session_nama_tahunakademik = '';
        }

        $session_nim = (Session::has('username')) ? Session::get('username') : '';
        $session_kode_prodi = (Session::has('kode_program_studi')) ? Session::get('kode_program_studi') : '';


        // $kode_prodi = $check_herregistrasi[0]->id_heregistrasi;

        $title = "KRS";
        $parent_breadcrumb = "Ambil KRS";
        // $child_breadcrumb = "Matakuliah Prasyarat";
        return view('Mahasiswa/krs/ambilkrs', compact('title', 'parent_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik', 'session_nim', 'session_kode_prodi'));
    }

    public function revisikrs(Request $request)
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
        if (Session::has('session_nama_tahunakademik')) {
            $session_nama_tahunakademik = Session::get('session_nama_tahunakademik');
        } else {
            $session_nama_tahunakademik = '';
        }

        $session_nim = (Session::has('username')) ? Session::get('username') : '';
        $session_kode_prodi = (Session::has('kode_program_studi')) ? Session::get('kode_program_studi') : '';

        $title = "Revisi KRS";
        $parent_breadcrumb = "Revisi KRS";
        // $child_breadcrumb = "Matakuliah Prasyarat";
        return view('Mahasiswa/krs/revisikrs', compact('title', 'parent_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik', 'session_nim', 'session_kode_prodi'));
    }

    public function transkripnilai(Request $request)
    {

        $session_tahun = (Session::has('session_tahun')) ? Session::get('session_tahun') : '';
        $session_semester = (Session::has('session_semester')) ? Session::get('session_semester') : '';
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';
        $session_nim = (Session::has('username')) ? Session::get('username') : '';
        $session_kode_prodi = (Session::has('kode_program_studi')) ? Session::get('kode_program_studi') : '';

        $title = "Transkip Nilai Mahasiswa";
        $parent_breadcrumb = "Transkip Nilai";
        return view('Mahasiswa/transkripnilai/transkripnilai', compact('title', 'parent_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik', 'session_nim', 'session_kode_prodi'));
    }

    public function kartuujian(Request $request)
    {

        $session_tahun = (Session::has('session_tahun')) ? Session::get('session_tahun') : '';
        $session_semester = (Session::has('session_semester')) ? Session::get('session_semester') : '';
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';
        $session_nim = (Session::has('username')) ? Session::get('username') : '';
        $session_kode_prodi = (Session::has('kode_program_studi')) ? Session::get('kode_program_studi') : '';

        $title = "Kartu Ujian Mahasiswa";
        $parent_breadcrumb = "Cetak Kartu";
        return view('Mahasiswa/kartuujian/kartuujian', compact('title', 'parent_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik', 'session_nim', 'session_kode_prodi'));
    }
    public function statuspembayaran(Request $request)
    {

        $session_tahun = (Session::has('session_tahun')) ? Session::get('session_tahun') : '';
        $session_semester = (Session::has('session_semester')) ? Session::get('session_semester') : '';
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';
        $session_nim = (Session::has('username')) ? Session::get('username') : '';
        $session_kode_prodi = (Session::has('kode_program_studi')) ? Session::get('kode_program_studi') : '';

        $title = "Status Pembayaran Mahasiswa";
        $parent_breadcrumb = "Status Pembayaran";
        return view('Mahasiswa/keuangan/statuspembayaran', compact('title', 'parent_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik', 'session_nim', 'session_kode_prodi'));
    }

    public function cetaktranskipnilai_mhs($a)
    {
        $nim = $a;

        $title = "Cetak Transkip Nilai";
        return view('Akademik/cetak/cetaktranskipnilai_mhs', compact('title', 'nim'));
    }

    public function ganti_password()
    {
        $session_tahun = (Session::has('session_tahun')) ? $session_tahun = Session::get('session_tahun') :  '';

        $session_semester = (Session::has('session_semester')) ?  Session::get('session_semester') : '';
        $session_kode_program_studi = (Session::has('kode_program_studi')) ? Session::get('kode_program_studi') : '';
        $session_nim = (Session::has('username')) ? Session::get('username') : '';

        $title = "Akun Mahasiswa";
        $parent_breadcrumb = "Pengaturan";
        $child_breadcrumb = "Ganti Password";
        return view('Mahasiswa/pengaturan/gantipassword', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_program_studi', 'session_nim'));
    }

    public function profil()
    {
        $session_tahun = (Session::has('session_tahun')) ? $session_tahun = Session::get('session_tahun') :  '';

        $session_semester = (Session::has('session_semester')) ?  Session::get('session_semester') : '';
        $session_kode_program_studi = (Session::has('kode_program_studi')) ? Session::get('kode_program_studi') : '';
        $session_nim = (Session::has('username')) ? Session::get('username') : '';

        $title = "Profil Mahasiswa";
        $parent_breadcrumb = "Profil";
        $child_breadcrumb = "-";
        return view('Mahasiswa/profil/profil', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_program_studi', 'session_nim'));
    }
}
