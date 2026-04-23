<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Akademik extends Controller
{

    public function index()
    {

        // Session::forget('session_tahun');
        // Session::forget('session_semester');
        // Session::forget('session_nama_tahunakademik');

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
        if (Session::has('nama')) {
            $session_nama = Session::get('nama');
        } else {
            $session_nama = '';
        }

        $title = "Akademik SIAKAD UP45";
        // return view('beranda', compact('title'));
        return view('beranda', compact('title', 'session_tahun', 'session_semester', 'session_nama_tahunakademik', 'session_nama'));
    }

    public function make_session(Request $request)
    {
        Session::put('session_tahun', $request->tahun);
        Session::put('session_semester', $request->semester);
        Session::put('session_nama_tahunakademik', $request->tahun_ajaran);

        return true;
    }

    public function getsession_ta()
    {
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';
        $ket = 'Tahun Akademik Aktif saat ini ' . $session_nama_tahunakademik;
        return response()->json(array('ket' => $ket), 200);

        // return response()->json(['ket' => $ket]);
    }

    public function berita_acara($a)
    {
        $session_tahun = (Session::has('session_tahun')) ? Session::get('session_tahun') : '';
        $session_semester = (Session::has('session_semester')) ? Session::get('session_semester') : '';
        $session_kode_dosen = isset($a) ? $a : '';
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';

        $title = "Berita Acara";
        $parent_breadcrumb = "Berita Acara";
        $child_breadcrumb = "";
        return view('Akademik/beritaacara/beritaacara', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik', 'session_kode_dosen'));
    }

    public function rekap_berita_acara()
    {
        $session_tahun = (Session::has('session_tahun')) ? Session::get('session_tahun') : '';
        $session_semester = (Session::has('session_semester')) ? Session::get('session_semester') : '';
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';

        $title = "Berita Acara";
        $parent_breadcrumb = "Rekap Berita Acara";
        $child_breadcrumb = "";
        return view('Akademik/beritaacara/rekap_beritaacara', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik'));
    }

    public function daftardosen()
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

        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';

        $title = "Daftar Dosen";
        $parent_breadcrumb = "Berita Acara Ujian Dosen Pengampu";
        $child_breadcrumb = "";

        return view('Akademik/beritaacara/daftardosen', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik'));
    }

    public function berita_acara_ujian($a)
    {
        $session_tahun = (Session::has('session_tahun')) ? Session::get('session_tahun') : '';
        $session_semester = (Session::has('session_semester')) ? Session::get('session_semester') : '';
        $session_kode_dosen = isset($a) ? $a : '';
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';

        $title = "Berita Acara";
        $parent_breadcrumb = "Berita Acara Ujian";
        $child_breadcrumb = "";
        return view('Akademik/beritaacaraujian/beritaacaraujian', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik', 'session_kode_dosen'));
    }

    public function daftardosen_ba_ujian()
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

        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';

        $title = "Daftar Dosen";
        $parent_breadcrumb = "Berita Acara Dosen Pengampu";
        $child_breadcrumb = "";

        return view('Akademik/beritaacaraujian/daftardosen', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik'));
    }

    public function tahunajaran()
    {

        $title = "Tahun Akademik";
        return view('Akademik/master/tahunakademik', compact('title'));
    }
    public function nilaimahasiswa()
    {
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';

        $title = "Data Transkip Nilai";
        return view('Akademik/mahasiswa/nilaimahasiswa', compact('title', 'session_nama_tahunakademik'));
    }

    public function kegiatanakademik()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/master/kegiatanakademik', compact('title'));
    }

    public function fakultas()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/master/fakultas', compact('title'));
    }
    public function programstudi()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/master/programstudi', compact('title'));
    }
    public function kurikulum()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/master/kurikulum', compact('title'));
    }

    public function kalenderakademik()
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

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/master/kalenderakademik', compact('title', 'session_tahun', 'session_semester'));
    }
    public function matakuliah()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/master/matakuliah', compact('title'));
    }
    public function dosen()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/master/dosen', compact('title'));
    }
    public function mahasiswa()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/mahasiswa/daftarmahasiswa', compact('title'));
    }
    public function passwordmahasiswa()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/mahasiswa/passwordmahasiswa', compact('title'));
    }
    public function registrasi()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/registrasi', compact('title'));
    }
    public function registrasipmb()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/registrasipmb', compact('title'));
    }
    public function herregistrasi()
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
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/herregistrasi', compact('title', 'session_nama_tahunakademik', 'session_tahun', 'session_semester'));
    }
    public function user()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/pengaturan/user', compact('title'));
    }

    public function makul_prasyarat()
    {

        $title = "Mata Kuliah Prasyarat";
        $parent_breadcrumb = "Data Matakuliah";
        $child_breadcrumb = "Matakuliah Prasyarat";
        return view('Akademik/matakuliah/makulprasyarat', compact('title', 'parent_breadcrumb', 'child_breadcrumb'));
    }
    public function makul_penawaran()
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
        return view('Akademik/matakuliah/makulpenawaran', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_fakultas', 'session_jabatan', 'session_nama_tahunakademik'));
    }

    public function inputnilaikhs()
    {
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';

        $title = "Nilai Hasil Studi";
        $parent_breadcrumb = "Data Matakuliah";
        $child_breadcrumb = "Input Nilai KHS";
        return view('Akademik/matakuliah/inputnilaikhs', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_nama_tahunakademik'));
    }

    public function importdatapmb()
    {

        $title = "Import Data PMB";
        $parent_breadcrumb = "Data Calon Mahasiswa";
        $child_breadcrumb = "Import Data PMB";
        return view('Akademik/calonmhsbaru/importdatapmb', compact('title', 'parent_breadcrumb', 'child_breadcrumb'));
    }

    public function tambahcalonmhs()
    {

        $title = "Import Data PMB";
        $parent_breadcrumb = "Data Calon Mahasiswa";
        $child_breadcrumb = "Import Data PMB";
        return view('Akademik/calonmhsbaru/tambahcalonmhs', compact('title', 'parent_breadcrumb', 'child_breadcrumb'));
    }

    public function lap_ipkmahasiswa()
    {

        $title = "Laporan IPK Mahasiswa";
        $parent_breadcrumb = "Laporan";
        $child_breadcrumb = "IPK Mahasiswa";



        return view('Akademik/laporan/ipkmahasiswa', compact('title', 'parent_breadcrumb', 'child_breadcrumb'));
    }

    public function lap_detailipkmhs($id)
    {
        // $tahun = $b;
        // $semester = $c;
        $kode_prodi = $id;
        $title = "Detail IPK Mahasiswa";
        $parent_breadcrumb = "Laporan";
        $child_breadcrumb = "IPK Mahasiswa";



        return view('Akademik/laporan/detail_ipkmhs', compact('kode_prodi', 'title', 'parent_breadcrumb', 'child_breadcrumb'));
    }

    public function lap_herregistrasi()
    {

        $title = "Laporan Her Registrasi Mahasiswa";
        $parent_breadcrumb = "Laporan";
        $child_breadcrumb = "Her Registrasi";
        return view('Akademik/laporan/herregistrasi', compact('title', 'parent_breadcrumb', 'child_breadcrumb'));
    }

    public function daftarhadirkuliah()
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
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';


        $title = "Daftar Hadir Kuliah";
        $parent_breadcrumb = "Perkuliahan";
        $child_breadcrumb = "Daftar Hadir Kuliah";
        return view('Akademik/printout/daftarhadirkuliah', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik', 'session_kode_fakultas', 'session_nama_tahunakademik'));
    }

    public function daftarhadirujian()
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
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';


        $title = "Daftar Hadir Kuliah";
        $parent_breadcrumb = "Perkuliahan";
        $child_breadcrumb = "Daftar Hadir Kuliah";

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/printout/daftarhadirujian', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_nama_tahunakademik', 'session_semester', 'session_kode_fakultas', 'session_nama_tahunakademik'));
    }

    public function kartuujian()
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


        $title = "Daftar Hadir Kuliah";
        $parent_breadcrumb = "Perkuliahan";
        $child_breadcrumb = "Daftar Hadir Kuliah";

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/printout/kartuujian', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik', 'session_kode_fakultas'));
    }

    public function hasilstudi()
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
        // $session_kode_fakultas = (Session::has('kode_fakultas')) ? Session::get('kode_fakultas') : '';


        $title = "Kartu Hasil Studi";
        $parent_breadcrumb = "Kartu Hasil Studi";
        $child_breadcrumb = "KHS Mahasiswa";

        return view('Akademik/printout/kartuhasilstudi', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik'));
    }
    public function dosenwali()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/master/dosenwali', compact('title'));
    }
    public function kewarganegaraan()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/laporan/kewarganegaraan', compact('title'));
    }
    public function dispensasi()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/laporan/dispensasi', compact('title'));
    }

    public function forminputcamaba($id)
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
        // if (Session::has('session_kode_fakultas')) {
        //     $session_kode_fakultas = Session::get('session_kode_fakultas');
        // } else {
        //     $session_kode_fakultas = '';
        // }
        $session_kode_fakultas = (Session::has('kode_fakultas')) ? Session::get('kode_fakultas') : '';
        $kode_prodi = $id;
        $title = "Form Input Calon Mahasiswa";
        $parent_breadcrumb = "Data Camaba";
        $child_breadcrumb = "Calon Mahasiswa";



        return view('Akademik/calonmhsbaru/inputcamaba', compact('kode_prodi', 'session_tahun', 'session_semester', 'session_nama_tahunakademik', 'session_kode_fakultas', 'title', 'parent_breadcrumb', 'child_breadcrumb'));
    }

    public function transkipnilai()
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


        $title = "Daftar Hadir Kuliah";
        $parent_breadcrumb = "Perkuliahan";
        $child_breadcrumb = "Daftar Hadir Kuliah";

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/printout/transkipnilai', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik'));
    }

    public function transkipakademik()
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


        $title = "Daftar Hadir Kuliah";
        $parent_breadcrumb = "Perkuliahan";
        $child_breadcrumb = "Daftar Hadir Kuliah";

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/printout/transkipakademik', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik'));
    }


    public function cetaktahunajaran()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/cetak/cetaktahunajaran', compact('title'));
    }


    public function cetaktranskipakademik($a)
    {
        $nim = $a;

        $title = "Cetak Transkip Akademik";
        return view('Akademik/cetak/cetaktranskipakademik', compact('title', 'nim'));
    }
    public function cetaktranskipakademikinggris($a)
    {
        $nim = $a;

        $title = "Cetak KRS";
        return view('Akademik/cetak/cetaktranskipakademikinggris', compact('title', 'nim'));
    }
    public function cetakdaftarhadirkuliah($id_tawar)
    {
        $id_tawar = $id_tawar;

        $title = "Cetak Daftar Hadir Kuliah";
        return view('Akademik/cetak/cetakdaftarhadirkuliah', compact('title', 'id_tawar'));
    }
    public function cetakdaftarhadirujian($id_tawar)
    {
        $id_tawar = $id_tawar;

        $title = "Cetak KRS";
        return view('Akademik/cetak/cetakdaftarhadirujian', compact('title', 'id_tawar'));
    }
    public function cetakkartuujian($nim, $tahun, $semester)
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
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';
        $nim = $nim;

        $title = "Cetak KRS";
        return view('Akademik/cetak/cetakkartuujian', compact('title', 'nim', 'session_tahun', 'session_semester', 'session_nama_tahunakademik'));
    }
    public function cetakkartuhasilstudi($nim, $tahun, $semester)
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
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';
        $nim = $nim;

        $title = "Cetak Kartu Hasil Studi";
        return view('Akademik/cetak/cetakkartuhasilstudi', compact('title', 'nim', 'session_tahun', 'session_semester', 'session_nama_tahunakademik'));
    }
    public function cetaktranskipnilai($a)
    {
        $nim = $a;

        $title = "Cetak Transkip Nilai";
        return view('Akademik/cetak/cetaktranskipnilai', compact('title', 'nim'));
    }
    public function daftarmaba()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/calonmhsbaru/daftarmaba', compact('title'));
    }
    public function mahasiswalulusan()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/calonmhsbaru/mahasiswalulusan', compact('title'));
    }
    public function gantipassword()
    {

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/pengaturan/gantipassword', compact('title'));
    }
    public function cetakkrs($a, $b, $c)
    {
        // function tgl_indo($tanggal)
        // {
        //     $bulan = array(
        //         1 =>   'Januari',
        //         'Februari',
        //         'Maret',
        //         'April',
        //         'Mei',
        //         'Juni',
        //         'Juli',
        //         'Agustus',
        //         'September',
        //         'Oktober',
        //         'November',
        //         'Desember'
        //     );
        //     $pecahkan = explode('-', $tanggal);

        //     return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        // }
        $nim = $a;
        $tahun = $b;
        $semester = $c;

        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';
        $tgl = date('d F Y');

        $title = "Cetak KRS";
        return view('Akademik/cetak/cetakkrs', compact('title', 'nim', 'semester', 'tahun', 'session_nama_tahunakademik', 'tgl'));
    }

    public function cetak_revisikrs($a, $b, $c)
    {

        $nim = $a;
        $tahun = $b;
        $semester = $c;

        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';
        $tgl = date('d F Y');

        $title = "Cetak KRS";
        return view('Akademik/cetak/cetak_revisikrs', compact('title', 'nim', 'semester', 'tahun', 'session_nama_tahunakademik', 'tgl'));
    }

    public function cetakkhs($a, $b, $c, $d)
    {
        $nim = $a;
        $tahun = $b;
        $semester = $c;
        $id_her = $d;

        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';
        $tgl = date('d F Y');

        $title = "Cetak KHS";
        return view('Akademik/cetak/cetakkhs_mhs', compact('title', 'nim', 'semester', 'tahun', 'session_nama_tahunakademik', 'tgl', 'id_her'));
    }
    public function editmaba($id_camaba)
    {
        $id_camaba = $id_camaba;

        $title = "Akademik SIAKAD UP45";
        $parent_breadcrumb = "Mahasiswa Baru";
        $child_breadcrumb = "Form Ubah Data Calon Mahasiswa Baru";
        return view('Akademik/calonmhsbaru/editmaba', compact('title', 'id_camaba', 'parent_breadcrumb', 'child_breadcrumb'));
    }

    public function inputnilaimahasiswa($id, $kode_program_studi)
    {
        $nim = $id;
        $kode_program_studi = $kode_program_studi;
        $title = "Form Input Calon Mahasiswa";
        $parent_breadcrumb = "Data Camaba";
        $child_breadcrumb = "Calon Mahasiswa";



        return view('Akademik/mahasiswa/inputnilaimahasiswa', compact('nim', 'kode_program_studi', 'title', 'parent_breadcrumb', 'child_breadcrumb'));
    }
    public function jamakcetakdaftarhadirkuliah($id_tawar)
    {
        $id_tawar = $id_tawar;

        $title = "Cetak Daftar Hadir Kuliah";
        return view('Akademik/cetak/jamakcetakdaftarhadirkuliah', compact('title', 'id_tawar'));
    }
    public function jamakcetakdaftarhadirujian($id_tawar)
    {
        $id_tawar = $id_tawar;

        $title = "Cetak Daftar Hadir Ujian";
        return view('Akademik/cetak/jamakcetakdaftarhadirujian', compact('title', 'id_tawar'));
    }
    public function jamakcetakkartuujian($nim, $tahun, $semester)
    {
        $nim = $nim;
        $tahun = $tahun;
        $semester = $semester;

        $title = "KARTU UJIAN";
        return view('Akademik/cetak/jamakcetakkartuujian', compact('title', 'nim', 'tahun', 'semester'));
    }
    public function jamakcetakkrsmahasiswa($nim, $tahun, $semester)
    {
        $nim = $nim;
        $tahun = $tahun;
        $semester = $semester;

        $title = "KARTU RENCANA STUDI";
        return view('Akademik/cetak/jamakcetakkrsmahasiswa', compact('title', 'nim', 'tahun', 'semester'));
    }

    public function krsmahasiswa()
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


        $title = "KARTU HASIL STUDI";
        $parent_breadcrumb = "Perkuliahan";
        $child_breadcrumb = "KARTU HASIL STUDI";

        $title = "Akademik SIAKAD UP45";
        return view('Akademik/printout/krsmahasiswa', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_nama_tahunakademik', 'session_kode_fakultas'));
    }
    public function cetakkrsmahasiswa($nim, $tahun, $semester)
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
        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';
        $nim = $nim;

        $title = "Cetak KRS";
        return view('Akademik/cetak/cetakkrsmahasiswa', compact('title', 'nim', 'session_tahun', 'session_semester', 'session_nama_tahunakademik'));
    }
    public function jamakcetakkartuhasilstudi($nim, $tahun, $semester)
    {
        $nim = $nim;
        $tahun = $tahun;
        $semester = $semester;

        $title = "KARTU RENCANA STUDI";
        return view('Akademik/cetak/jamakcetakkartuhasilstudi', compact('title', 'nim', 'tahun', 'semester'));
    }

    public function cetakberitaacara($a)
    {
        $id_kelas = $a;

        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';
        $tgl = date('d F Y');

        $title = "Cetak Berita Acara";
        return view('Akademik/cetak/cetakberitaacara', compact('title', 'id_kelas', 'session_nama_tahunakademik', 'tgl'));
    }

    public function cetakberitaacaraujian($id)
    {
        $id_ba_ujian = $id;
        // $id_kelas = $b;
        // $jenis_ujian = 'UTS/UAS';

        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';
        $tgl = date('d F Y');

        $title = "Cetak Berita Acara Ujian";
        return view('Akademik/cetak/cetakberitaacaraujian', compact('title', 'id_ba_ujian', 'session_nama_tahunakademik', 'tgl'));
    }

    public function cetakpresensi($a)
    {
        $id_kelas = $a;

        $session_nama_tahunakademik = (Session::has('session_nama_tahunakademik')) ? Session::get('session_nama_tahunakademik') : '';
        $tgl = date('d F Y');

        $title = "Cetak Presensi";
        return view('Akademik/cetak/cetakpresensi', compact('title', 'id_kelas', 'session_nama_tahunakademik', 'tgl'));
    }
    public function data_dosenwali()
    {

        $session_tahun = (Session::has('session_tahun')) ? Session::get('session_tahun') : '';
        $session_semester = (Session::has('session_semester')) ? Session::get('session_semester') : '';
        // $session_kode_fakultas = (Session::has('kode_fakultas')) ? Session::get('kode_fakultas') : '';
        $session_jabatan = (Session::has('jabatan')) ? Session::get('jabatan') : '';

        $title = "Daftar Dosen Wali";
        return view('Akademik/master/dosenwali', compact('title', 'session_tahun', 'session_semester', 'session_jabatan'));
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
        // $session_kode_program_studi = (Session::has('kode_program_studi')) ? Session::get('kode_program_studi') : '';

        // $session_tipe = (Session::has('tipe')) ? Session::get('tipe') : '';
        // $session_kode_dosen = (Session::has('id_dosen')) ? Session::get('id_dosen') : '';

        $title = "Input Nilai Mata Kuliah";
        $parent_breadcrumb = "Mata Kuliah Diampu";
        $child_breadcrumb = "";
        return view('Akademik/matakuliah/inputnilaikhs/inputnilaikhs', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester'));
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
        return view('Akademik/matakuliah/inputnilaikhs/form_inputnilaiuts', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_program_studi', 'session_tipe', 'session_kode_dosen', 'id_kelas'));
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
        return view('Akademik/matakuliah/inputnilaikhs/form_inputnilaiuas', compact('title', 'parent_breadcrumb', 'child_breadcrumb', 'session_tahun', 'session_semester', 'session_kode_program_studi', 'session_tipe', 'session_kode_dosen', 'id_kelas'));
    }
}
