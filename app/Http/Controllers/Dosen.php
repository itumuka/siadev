<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Dosen extends Controller
{
    //
    public function daftarmhs_pa(Request $request)
    {

        $session_tipe = (Session::has('tipe')) ? Session::get('tipe') : '';
        $session_kode_dosen = (Session::has('id_dosen')) ? Session::get('id_dosen') : '';

        $session_tahun = (Session::has('session_tahun')) ? Session::get('session_tahun') : '';
        $session_semester = (Session::has('session_semester')) ? Session::get('session_semester') : '';
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';
        $session_nim = (Session::has('username')) ? Session::get('username') : '';
        $session_kode_program_studi = (Session::has('kode_program_studi')) ? Session::get('kode_program_studi') : '';

        $title = "Mahasiswa Pembimbing Akademik";
        $parent_breadcrumb = "Daftar Mahasiswa";
        $child_breadcrumb = "";

        return view('Dosen/daftarmhs_pa/daftarmhs_pa', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_program_studi', 'session_tipe', 'session_kode_dosen'));
    }
    public function acckrs()
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

        $session_id_dosen = (Session::has('id_dosen')) ? Session::get('id_dosen') : '';
        $session_nidn = (Session::has('nidn')) ? Session::get('nidn') : '';
        $session_dosen_wali = (Session::has('dosen_wali')) ? Session::get('dosen_wali') : '';


        $title = "ACC KRS";
        $parent_breadcrumb = "KRS";
        $child_breadcrumb = "ACC KRS";

        return view('Dosen/krs/acckrs', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik', 'session_id_dosen', 'session_nidn', 'session_dosen_wali'));
    }

    public function makul_diampu_dosen()
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
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';

        $title = "Mata Kuliah Diampu";
        $parent_breadcrumb = "Mata Kuliah Diampu";
        $child_breadcrumb = "";
        return view('Dosen/makuldiampu/makuldiampu', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_program_studi', 'session_tipe', 'session_kode_dosen', 'session_nama_tahunakademik'));
    }

    public function input_nilai_khs()
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

        $title = "Input Nilai Mata Kuliah";
        $parent_breadcrumb = "Mata Kuliah Diampu";
        $child_breadcrumb = "";
        return view('Dosen/inputnilaikhs/inputnilaikhs', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_program_studi', 'session_tipe', 'session_kode_dosen'));
    }

    public function form_input_nilai_uts(Request $request)
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
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';

        $session_tipe = (Session::has('tipe')) ? Session::get('tipe') : '';
        $session_kode_dosen = (Session::has('id_dosen')) ? Session::get('id_dosen') : '';
        $id_kelas = $request->id_kelas;
        $title = "Form Input Nilai Mahasiswa";
        $parent_breadcrumb = "Mata Kuliah Diampu";
        $child_breadcrumb = "Form Input Nilai UTS";
        return view('Dosen/inputnilaikhs/form_inputnilaiuts', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_program_studi', 'session_tipe', 'session_kode_dosen', 'id_kelas'));
    }
    public function form_input_nilai_uas(Request $request)
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
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';

        $session_tipe = (Session::has('tipe')) ? Session::get('tipe') : '';
        $session_kode_dosen = (Session::has('id_dosen')) ? Session::get('id_dosen') : '';
        $id_kelas = $request->id_kelas;
        $title = "Form Input Nilai Mahasiswa";
        $parent_breadcrumb = "Mata Kuliah Diampu";
        $child_breadcrumb = "Form Input Nilai UAS";
        return view('Dosen/inputnilaikhs/form_inputnilaiuas', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_program_studi', 'session_tipe', 'session_kode_dosen', 'id_kelas'));
    }


    public function berita_acara()
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
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';

        $title = "Jurnal Perkuliahan";
        $parent_breadcrumb = "Jurnal Perkuliahan";
        $child_breadcrumb = "";
        return view('Dosen/beritaacara/beritaacara', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_program_studi', 'session_tipe', 'session_kode_dosen', 'session_nama_tahunakademik'));
    }

    public function berita_acara_ujian()
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
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';

        $title = "Berita Acara Ujian";
        $parent_breadcrumb = "Berita Acara Ujian";
        $child_breadcrumb = "";
        return view('Dosen/beritaacaraujian/beritaacaraujian', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_program_studi', 'session_tipe', 'session_kode_dosen', 'session_nama_tahunakademik'));
    }

    public function presensi_mhs()
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
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';

        $title = "Presensi Mahasiswa";
        $parent_breadcrumb = "Data Presensi";
        $child_breadcrumb = "";
        return view('Dosen/presensi_mhs/presensi_mhs', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_program_studi', 'session_tipe', 'session_kode_dosen', 'session_nama_tahunakademik'));
    }

    public function riwayat_mengajar()
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

        $title = "Riwayat Mengajar";
        $parent_breadcrumb = "Data Riwayat Mengajar";
        $child_breadcrumb = "";
        return view('Dosen/riwayatmengajar/riwayatmengajar', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_program_studi', 'session_tipe', 'session_kode_dosen'));
    }

    public function ganti_password()
    {
        $session_tahun = (Session::has('session_tahun')) ? $session_tahun = Session::get('session_tahun') :  '';

        $session_semester = (Session::has('session_semester')) ?  Session::get('session_semester') : '';
        $session_kode_program_studi = (Session::has('kode_program_studi')) ? Session::get('kode_program_studi') : '';

        $session_tipe = (Session::has('tipe')) ? Session::get('tipe') : '';
        $session_kode_dosen = (Session::has('id_dosen')) ? Session::get('id_dosen') : '';

        $title = "Akun Dosen";
        $parent_breadcrumb = "Pengaturan";
        $child_breadcrumb = "Ganti Password";
        return view('Dosen/pengaturan/gantipassword', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_program_studi', 'session_tipe', 'session_kode_dosen'));
    }
}
