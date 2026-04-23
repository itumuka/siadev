<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Dekanat extends Controller
{
    //

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
        $session_kode_fakultas = (Session::has('kode_fakultas')) ? Session::get('kode_fakultas') : '';


        $title = "ACC KRS";
        $parent_breadcrumb = "KRS";
        $child_breadcrumb = "ACC KRS";

        return view('Dekanat/krs/acckrs', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik', 'session_kode_fakultas'));
    }

    public function makul_penawaran_dekan()
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
        $session_kode_fakultas = (Session::has('kode_fakultas')) ? Session::get('kode_fakultas') : '';
        $session_jabatan = (Session::has('jabatan')) ? Session::get('jabatan') : '';
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';

        $title = "Mata Kuliah Penawaran";
        $parent_breadcrumb = "Data Matakuliah";
        $child_breadcrumb = "Mata Kuliah Penawaran";
        return view('Dekanat/matakuliah/makulpenawaran', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_fakultas', 'session_jabatan', 'session_nama_tahunakademik'));
    }

    public function transkrip_nilai()
    {

        $session_tahun = (Session::has('session_tahun')) ? Session::get('session_tahun') : '';
        $session_semester = (Session::has('session_semester')) ? Session::get('session_semester') : '';
        $session_kode_fakultas = (Session::has('kode_fakultas')) ? Session::get('kode_fakultas') : '';
        $session_jabatan = (Session::has('jabatan')) ? Session::get('jabatan') : '';

        $title = "Transkip Nilai Mahasiswa";
        return view('Dekanat/transkripnilai/transkipnilai', compact('title', 'session_tahun', 'session_semester', 'session_kode_fakultas', 'session_jabatan'));
    }

    public function daftarhadirkuliah()
    {

        $session_tahun = (Session::has('session_tahun')) ? Session::get('session_tahun') : '';
        $session_semester = (Session::has('session_semester')) ? Session::get('session_semester') : '';
        $session_kode_fakultas = (Session::has('kode_fakultas')) ? Session::get('kode_fakultas') : '';
        $session_jabatan = (Session::has('jabatan')) ? Session::get('jabatan') : '';
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';

        $title = "Daftar Hadir Kuliah";
        return view('Dekanat/daftarhadirkuliah/daftarhadirkuliah', compact('title', 'session_tahun', 'session_semester', 'session_kode_fakultas', 'session_jabatan', 'session_nama_tahunakademik'));
    }

    public function daftarhadirujian()
    {

        $session_tahun = (Session::has('session_tahun')) ? Session::get('session_tahun') : '';
        $session_semester = (Session::has('session_semester')) ? Session::get('session_semester') : '';
        $session_kode_fakultas = (Session::has('kode_fakultas')) ? Session::get('kode_fakultas') : '';
        $session_jabatan = (Session::has('jabatan')) ? Session::get('jabatan') : '';
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';

        $title = "Daftar Hadir Ujian";
        return view('Dekanat/daftarhadirujian/daftarhadirujian', compact('title', 'session_tahun', 'session_semester', 'session_kode_fakultas', 'session_jabatan', 'session_nama_tahunakademik'));
    }

    public function transkripakademik()
    {

        $session_tahun = (Session::has('session_tahun')) ? Session::get('session_tahun') : '';
        $session_semester = (Session::has('session_semester')) ? Session::get('session_semester') : '';
        $session_kode_fakultas = (Session::has('kode_fakultas')) ? Session::get('kode_fakultas') : '';
        $session_jabatan = (Session::has('jabatan')) ? Session::get('jabatan') : '';

        $title = "Daftar Hadir Ujian";
        return view('Dekanat/transkripakademik/transkripakademik', compact('title', 'session_tahun', 'session_semester', 'session_kode_fakultas', 'session_jabatan'));
    }


    public function lap_ipkmahasiswa()
    {

        $title = "Laporan IPK Mahasiswa";
        $parent_breadcrumb = "Laporan";
        $child_breadcrumb = "IPK Mahasiswa";
        $session_kode_fakultas = (Session::has('kode_fakultas')) ? Session::get('kode_fakultas') : '';


        return view('Dekanat/laporan/ipkmahasiswa', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_kode_fakultas'));
    }

    public function registrasi()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Dekanat/registrasi', compact('title'));
    }

    public function lap_detailipkmhs($id)
    {
        // $tahun = $b;
        // $semester = $c;
        $kode_prodi = $id;
        $title = "Detail IPK Mahasiswa";
        $parent_breadcrumb = "Laporan";
        $child_breadcrumb = "IPK Mahasiswa";



        return view('Dekanat/laporan/detail_ipkmhs', compact('kode_prodi', 'title', 'parent_breadcrumb', 'child_breadcrumb'));
    }



    public function data_dosenwali()
    {

        $session_tahun = (Session::has('session_tahun')) ? Session::get('session_tahun') : '';
        $session_semester = (Session::has('session_semester')) ? Session::get('session_semester') : '';
        $session_kode_fakultas = (Session::has('kode_fakultas')) ? Session::get('kode_fakultas') : '';
        $session_jabatan = (Session::has('jabatan')) ? Session::get('jabatan') : '';

        $title = "Daftar Dosen Wali";
        return view('Dekanat/dosenwali/dosenwali', compact('title', 'session_tahun', 'session_semester', 'session_kode_fakultas', 'session_jabatan'));
    }

    public function daftar_mhs()
    {

        $session_tahun = (Session::has('session_tahun')) ? Session::get('session_tahun') : '';
        $session_semester = (Session::has('session_semester')) ? Session::get('session_semester') : '';
        $session_kode_fakultas = (Session::has('kode_fakultas')) ? Session::get('kode_fakultas') : '';
        $session_jabatan = (Session::has('jabatan')) ? Session::get('jabatan') : '';

        $title = "Data Mahasiswa";
        $parent_breadcrumb = "Mahasiswa Fakultas";
        $child_breadcrumb = "";
        return view('Dekanat/daftarmhs_pa/daftarmhs_pa', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_fakultas', 'session_jabatan'));
    }

    public function gantipassword()
    {

        $title = "Ganti Password";
        return view('Dekanat/pengaturan/gantipassword', compact('title'));
    }


    public function input_nilai_khs()
    {
        $session_tahun = (Session::has('session_tahun')) ? Session::get('session_tahun') : '';
        $session_semester = (Session::has('session_semester')) ? Session::get('session_semester') : '';
        $session_kode_fakultas = (Session::has('kode_fakultas')) ? Session::get('kode_fakultas') : '';
        $session_jabatan = (Session::has('jabatan')) ? Session::get('jabatan') : '';


        $title = "Input Nilai Mata Kuliah Fakultas";
        $parent_breadcrumb = "";
        $child_breadcrumb = "";
        return view('Dekanat/inputnilaikhs/inputnilaikhs', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_fakultas', 'session_jabatan'));
    }

    public function form_input_nilai_uts(Request $request)
    {
        $session_tahun = (Session::has('session_tahun')) ? Session::get('session_tahun') : '';
        $session_semester = (Session::has('session_semester')) ? Session::get('session_semester') : '';
        $session_kode_fakultas = (Session::has('kode_fakultas')) ? Session::get('kode_fakultas') : '';
        $session_jabatan = (Session::has('jabatan')) ? Session::get('jabatan') : '';

        $id_kelas = $request->id_kelas;
        $title = "Form Input Nilai Mahasiswa";
        $parent_breadcrumb = "Mata Kuliah Diampu";
        $child_breadcrumb = "Form Input Nilai UTS";
        return view('Dekanat/inputnilaikhs/form_inputnilaiuts', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_fakultas', 'session_jabatan', 'id_kelas'));
    }
    public function form_input_nilai_uas(Request $request)
    {

        $session_tahun = (Session::has('session_tahun')) ? Session::get('session_tahun') : '';
        $session_semester = (Session::has('session_semester')) ? Session::get('session_semester') : '';
        $session_kode_fakultas = (Session::has('kode_fakultas')) ? Session::get('kode_fakultas') : '';
        $session_jabatan = (Session::has('jabatan')) ? Session::get('jabatan') : '';

        $id_kelas = $request->id_kelas;
        $title = "Form Input Nilai Mahasiswa";
        $parent_breadcrumb = "Mata Kuliah Fakultas";
        $child_breadcrumb = "Form Input Nilai UAS";
        return view('Dekanat/inputnilaikhs/form_inputnilaiuas', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_fakultas', 'session_jabatan', 'id_kelas'));
    }

    public function skripsi_index_sk()
    {
        $session_tahun = (Session::has('session_tahun')) ? Session::get('session_tahun') : '';
        $session_semester = (Session::has('session_semester')) ? Session::get('session_semester') : '';
        $session_kode_fakultas = (Session::has('kode_fakultas')) ? Session::get('kode_fakultas') : '';
        $session_jabatan = (Session::has('jabatan')) ? Session::get('jabatan') : '';

        $title = "Validasi SK Pembimbing Skripsi";
        $parent_breadcrumb = "Manajemen Skripsi";
        $child_breadcrumb = "Validasi SK";
        return view('Dekanat/skripsi/index_sk', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_fakultas', 'session_jabatan'));
    }

    public function skripsi_print_sk($id)
    {
        $title = "Cetak SK Pembimbing";
        return view('Dekanat/skripsi/print_sk', compact('title', 'id'));
    }
}
