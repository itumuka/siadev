<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", "LoginController@index")->name('login');
Route::get("/logout", "LoginController@logout")->name('logout');
Route::get("/makesession-pegawai", "LoginController@make_session_pegawai")->name('makesession_pegawai');
Route::get("/makesession-mahasiswa", "LoginController@make_session_mahasiswa")->name('make_session_mahasiswa');
Route::get("/makesession-dosen", "LoginController@make_session_dosen")->name('make_session_dosen');
Route::get("/get-session-ta", "Akademik@getsession_ta")->name('getsession_ta');

Route::middleware(['ceklogin'])->group(function () {

    // Route::get('/', function () {
    //     return view('beranda');
    // });
    Route::get("/check-session", "Mahasiswa@check_session")->name('check_session');
    Route::get("/home", "Akademik@index")->name('home');
    Route::get("/akademik/make-session", "Akademik@make_session")->name('make_session');

    // Route::group(['middleware' => ['cekmahasiswa', 'cekdosen', 'cekpegawai']], function () {
    // });

    Route::get("/akademik/cetak/cetakkrs/{a}/{b}/{c}", "Akademik@cetakkrs")->name('cetakkrs');
    Route::get("/akademik/cetak/cetakkhs/{a}/{b}/{c}/{d}/{e?}", "Akademik@cetakkhs")->name('mhs_cetakkhs');
    Route::get("/akademik/cetak/cetakberitaacara/{a}", "Akademik@cetakberitaacara")->name('cetakberitaacara');
    Route::get("/akademik/cetak/cetakberitaacaraujian/{id}", "Akademik@cetakberitaacaraujian")->name('cetakberitaacaraujian');
    Route::get("/akademik/cetak/cetakpresensi/{a}", "Akademik@cetakpresensi")->name('cetakpresensi');
    Route::get("/akademik/cetak/cetakkartuujian/{nim}/{tahun}/{semester}/{jenisujian}", "Akademik@cetakkartuujian")->name('cetakkartuujian');
    Route::get("/akademik/cetak/cetak-revisi-krs/{a}/{b}/{c}", "Akademik@cetak_revisikrs")->name('cetak_revisikrs');
    Route::get("/mahasiswa/cetak/cetaktranskipnilai-mhs/{a}", "Mahasiswa@cetaktranskipnilai_mhs")->name('cetaktranskipnilai_mhs');

    Route::get("/akademik/input-nilai-khs", "Akademik@input_nilai_khs")->name('input_nilai_khs_akademik');
    Route::get("/akademik/form-input-nilai-uts", "Akademik@form_input_nilai_uts")->name('form_input_nilai_uts_akademik');
    Route::get("/akademik/form-input-nilai-uas", "Akademik@form_input_nilai_uas")->name('form_input_nilai_uas_akademik');
    Route::get("/akademik/daftardosen", "Akademik@daftardosen")->name('akdaftardosen');
    Route::get("/akademik/berita-acara/{a}", "Akademik@berita_acara")->name('akdberita_acara_dosen');
    Route::get("/akademik/berita-acara-ujian/{a}", "Akademik@berita_acara_ujian")->name('akdberita_acara_ujian_dosen');

    Route::get("/akademik/lihat-penilaian", "Akademik@lihat_penilaian")->name('aklihat_penilaian');
    Route::get("/kaprodi/lihat-penilaian", "Kaprodi@lihat_penilaian")->name('kplihat_penilaian');
    
    Route::get("/dosen/input-nilai-khs", "Dosen@input_nilai_khs")->name('input_nilai_khs_dosen');
    Route::get("/dosen/form-input-nilai-uts", "Dosen@form_input_nilai_uts")->name('form_input_nilai_uts_dosen');
    Route::get("/dosen/form-input-nilai-uas", "Dosen@form_input_nilai_uas")->name('form_input_nilai_uas_dosen');
    Route::middleware(['cekmahasiswa'])->group(function () {
        Route::get("/mahasiswa/jadwal-kuliah", "Mahasiswa@jadwalkuliah")->name('jadwalkuliah');
        Route::get("/mahasiswa/presensi-kuliah", "Mahasiswa@presensikuliah")->name('presensikuliah');
        Route::get("/mahasiswa/revisi-krs", "Mahasiswa@revisikrs")->name('mhsrevisikrs');
        Route::get("/mahasiswa/krs", "Mahasiswa@krs")->name('mhskrs');
        Route::get("/mahasiswa/khs", "Mahasiswa@khs")->name('mhskhs');
        Route::get("/mahasiswa/transkrip-nilai", "Mahasiswa@transkripnilai")->name('mhstranskripnilai');
        Route::get("/mahasiswa/kartu-ujian", "Mahasiswa@kartuujian")->name('mhskartuujian');
        Route::get("/mahasiswa/statuspembayaran", "Mahasiswa@statuspembayaran")->name('statuspembayaran');
        Route::get("/mahasiswa/ganti-password", "Mahasiswa@ganti_password")->name('mhsgantipassword');
        Route::get("/mahasiswa/profil", "Mahasiswa@profil")->name('mhsprofil');
    });
    // Route::get("/dosen/input-nilai-khs", "Dosen@input_nilai_khs")->name('input_nilai_khs_dosen');
    // Route::get("/dosen/form-input-nilai-khs", "Dosen@form_input_nilai_khs")->name('form_input_nilai_khs_dosen');

    Route::middleware(['cekdosen'])->group(function () {
        Route::get("/dosen/acc-krs", "Dosen@acckrs")->name('dosenacckrs');
        Route::get("/dosen/daftarmhs-pa", "Dosen@daftarmhs_pa")->name('dosendaftarmhs_pa');
        Route::get("/dosen/makul-diampu", "Dosen@makul_diampu_dosen")->name('makul_diampu_dosen');
        Route::get("/dosen/berita-acara", "Dosen@berita_acara")->name('berita_acara_dosen');
        Route::get("/dosen/berita-acara-ujian", "Dosen@berita_acara_ujian")->name('berita_acara_ujian_dosen');
        Route::get("/dosen/riwayat-mengajar", "Dosen@riwayat_mengajar")->name('dsnriwayat_mengajar');
        Route::get("/dosen/presensi-mhs", "Dosen@presensi_mhs")->name('dsnpresensi_mhs');
        Route::get("/dosen/ganti-password", "Dosen@ganti_password")->name('dsngantipassword');
        Route::post("/akademik/qrcodedowalacc", "Akademik@saveAllQrCodeACC")->name('qrcodedowalacc');
    });

    Route::middleware(['cekpegawai'])->group(function () {
        Route::get("/dekanat/acc-krs", "Dekanat@acckrs")->name('dknacckrs');
        Route::get("/dekanat/makulpenawaran", "Dekanat@makul_penawaran_dekan")->name('dknmakulpenawaran');
        Route::get("/dekanat/transkrip-nilai", "Dekanat@transkrip_nilai")->name('dkntranskrip_nilai');
        Route::get("/dekanat/daftarhadir-kuliah", "Dekanat@daftarhadirkuliah")->name('dkndaftarhadirkuliah');
        Route::get("/dekanat/daftarhadir-ujian", "Dekanat@daftarhadirujian")->name('dkndaftarhadirujian');
        Route::get("/dekanat/transkrip-akademik", "Dekanat@transkripakademik")->name('dkntranskripakademik');
        Route::get("/dekanat/daftar-mhs", "Dekanat@daftar_mhs")->name('dkndaftar_mhs');
        Route::get("/dekanat/setting-dosenwali", "Dekanat@data_dosenwali")->name('dkndosenwali');
        Route::get("/dekanat/input-khs", "Dekanat@input_nilai_khs")->name('dkninput_nilai_khs');
        Route::get("/dekanat/dekanregistrasi", "Dekanat@registrasi")->name('dekregistrasi');

        Route::get("/dekanat/form-input-nilai-uts", "Dekanat@form_input_nilai_uts")->name('dknform_input_nilai_uts_akademik');
        Route::get("/dekanat/form-input-nilai-uas", "Dekanat@form_input_nilai_uas")->name('dknform_input_nilai_uas_akademik');

        Route::get("/dekanat/ganti-password", "Dekanat@gantipassword")->name('dkngantipassword');
        Route::get("/dekanat/laporan/ipk-mhs", "Dekanat@lap_ipkmahasiswa")->name('dknlap_ipkmahasiswa');
        Route::get("/dekanat/laporan/detail-ipk-mhs/{id}", "Dekanat@lap_detailipkmhs")->name('dknlap_detail_ipkmhs');


        Route::get("/akademik/tahunajaran", "Akademik@tahunajaran")->name('aktahunajaran');
        Route::get("/akademik/makulprasyarat", "Akademik@makul_prasyarat")->name('akmakulprasyarat');
        Route::get("/akademik/makulpenawaran", "Akademik@makul_penawaran")->name('akmakulpenawaran');
        Route::get("/akademik/jadwalujian", "Akademik@jadwalujian")->name('akjadwalujian');    
        Route::get("/akademik/input-khs", "Akademik@inputnilaikhs")->name('akinputnilaikhs');
        Route::get("/akademik/importdatapmb", "Akademik@importdatapmb")->name('akimportdatapmb');
        Route::get("/akademik/tambah-calon-mhs", "Akademik@tambahcalonmhs")->name('aktambahcalonmhs');
        Route::get("/akademik/laporan/ipk-mhs", "Akademik@lap_ipkmahasiswa")->name('lap_ipkmahasiswa');
        Route::get("/akademik/laporan/detail-ipk-mhs/{id}", "Akademik@lap_detailipkmhs")->name('lap_detail_ipkmhs');
        Route::get("/akademik/laporan/herregistrasi", "Akademik@lap_herregistrasi")->name('lap_herregistrasi');
        Route::get("/akademik/cetak/cetaktahunajaran", "Akademik@cetaktahunajaran")->name('cetaktahunajaran');
        Route::get("/akademik/presensi-mhs", "Akademik@presensi_mhs")->name('akdpresensi_mhs');
        Route::get("/akademik/daftardosen-ba-ujian", "Akademik@daftardosen_ba_ujian")->name('akdaftardosen_ba_ujian');
        Route::get("/akademik/berita-acara-ujian/{a}", "Akademik@berita_acara_ujian")->name('akdberita_acara_ujian_dosen');
        Route::get("/akademik/rekap-berita-acara", "Akademik@rekap_berita_acara")->name('rekap_ba_dosen');
        Route::get("/akademik/kegiatanakademik", "Akademik@kegiatanakademik")->name('akkegiatanakademik');
        Route::get("/akademik/fakultas", "Akademik@fakultas")->name('akfakultas');
        Route::get("/akademik/programstudi", "Akademik@programstudi")->name('akprogramstudi');
        Route::get("/akademik/kurikulum", "Akademik@kurikulum")->name('akkurikulum');
        Route::get("/akademik/kalenderakademik", "Akademik@kalenderakademik")->name('akkalenderakademik');
        Route::get("/akademik/matakuliah", "Akademik@matakuliah")->name('akmatakuliah');
        Route::get("/akademik/dosen", "Akademik@dosen")->name('akdosen');
        Route::get("/akademik/qrcode", "Akademik@qrcode")->name('akqrcode');
        Route::get("/akademik/qrcodemanajemen", "Akademik@qrcodemanajemen")->name('akqrcodemanajemen');
        Route::post("/akademik/qrcodedosen", "Akademik@saveAllQrCode")->name('qrcodedosen');
        Route::post("/akademik/qrcodedosenmanajemen", "Akademik@saveAllQrCodeManajemen")->name('qrcodedosenmanajemen');
        Route::get("/akademik/mahasiswa", "Akademik@mahasiswa")->name('akmahasiswa');
        Route::get("/akademik/passwordmahasiswa", "Akademik@passwordmahasiswa")->name('akpasswordmahasiswa');
        Route::get("/akademik/nilaimahasiswa", "Akademik@nilaimahasiswa")->name('aknilaimahasiswa');
        Route::get("/akademik/registrasi", "Akademik@registrasi")->name('akregistrasi');
        Route::get("/akademik/registrasipmb", "Akademik@registrasipmb")->name('akregistrasipmb');
        Route::get("/akademik/herregistrasi", "Akademik@herregistrasi")->name('akherregistrasi');
        Route::get("/akademik/user", "Akademik@user")->name('akuser');
        Route::get("/akademik/daftarhadirkuliah", "Akademik@daftarhadirkuliah")->name('akdaftarhadirkuliah');
        Route::get("/akademik/daftarhadirujian", "Akademik@daftarhadirujian")->name('akdaftarhadirujian');
        Route::get("/akademik/kartuujian", "Akademik@kartuujian")->name('akkartuujian');
        Route::get("/akademik/hasilstudi", "Akademik@hasilstudi")->name('akhasilstudi');
        Route::get("/akademik/dosenwali", "Akademik@dosenwali")->name('akdosenwali');
        Route::get("/akademik/laporan/kewarganegaraan", "Akademik@kewarganegaraan")->name('kewarganegaraan');
        Route::get("/akademik/laporan/dispensasi", "Akademik@dispensasi")->name('dispensasi');
        Route::get("/akademik/calonmhsbaru/form-input-camaba/{id}", "Akademik@forminputcamaba")->name('forminputcamaba');
        Route::get("/akademik/transkipnilai", "Akademik@transkipnilai")->name('aktranskipnilai');
        Route::get("/akademik/transkipakademik", "Akademik@transkipakademik")->name('aktranskipakademik');

        Route::get("/akademik/cetak/cetaktranskipakademikinggris/{a}/{b}/{c}", "Akademik@cetaktranskipakademikinggris")->name('cetaktranskipakademikinggris');
        Route::get("/akademik/cetak/cetakdaftarhadirkuliah/{id_tawar}", "Akademik@cetakdaftarhadirkuliah")->name('cetakdaftarhadirkuliah');
        Route::get("/akademik/cetak/cetakdaftarhadirujian/{id_tawar}", "akademik@cetakdaftarhadirujian")->name('cetakdaftarhadirujian');

        Route::get("/akademik/cetak/cetakkartuhasilstudi/{nim}/{tahun}/{semester}", "Akademik@cetakkartuhasilstudi")->name('cetakkartuhasilstudi');
        Route::get("/akademik/calonmhsbaru/daftarmaba", "Akademik@daftarmaba")->name('daftarmaba');
        Route::get("/akademik/mahasiswalulusan", "Akademik@mahasiswalulusan")->name('mahasiswalulusan');
        Route::get("/akademik/gantipassword", "Akademik@gantipassword")->name('gantipassword');
        // Route::get("/akademik/cetak/cetakkartuhasilstudi/{a}/{b}/{c}", "akademik@cetakkhs")->name('cetakkhs');
        Route::get("/akademik/cetak/cetaktranskipnilai/{a}", "Akademik@cetaktranskipnilai")->name('cetaktranskipnilai');
        Route::get("/akademik/calonmhsbaru/edit-mahasiswabaru/{id_camaba}", "Akademik@editmaba")->name('editmaba');
        Route::get("/akademik/mahasiswa/form-input-nilai/{id}/{kode_program_studi}", "Akademik@inputnilaimahasiswa")->name('inputnilaimahasiswa');
        Route::get("/akademik/krsmahasiswa", "Akademik@krsmahasiswa")->name('akkrsmahasiswa');
        Route::get("/akademik/cetak/cetakkrsmahasiswa/{nim}/{tahun}/{semester}", "Akademik@cetakkrsmahasiswa")->name('cetakkrsmahasiswa');
        Route::get("/akademik/setting-dosenwali", "Akademik@data_dosenwali")->name('akddosenwali');
    });
    Route::get("/akademik/cetak/cetakdaftarhadirujiandosen/{id_tawar}", "Akademik@cetakdaftarhadirujian")->name('cetakdaftarhadirujiandosen');
    Route::get("/akademik/cetak/cetaktranskipakademik/{a}", "Akademik@cetaktranskipakademik")->name('cetaktranskipakademik');
    Route::get("/akademik/cetak/jamakcetakdaftarhadirkuliah/{id_tawar}", "Akademik@jamakcetakdaftarhadirkuliah")->name('jamakcetakdaftarhadirkuliah');
    Route::get("/akademik/cetak/jamakcetakdaftarhadirujian/{id_tawar}/{jenisujian}", "Akademik@jamakcetakdaftarhadirujian")->name('jamakcetakdaftarhadirujian');
    Route::get("/akademik/cetak/jamakcetakkartuujian/{nim}/{tahun}/{semester}/{jenisujian}", "Akademik@jamakcetakkartuujian")->name('jamakcetakkartuujian');
    Route::get("/akademik/cetak/jamakcetakkrsmahasiswa/{nim}/{tahun}/{semester}", "Akademik@jamakcetakkrsmahasiswa")->name('jamakcetakkrsmahasiswa');
    Route::get("/akademik/cetak/jamakcetakkartuhasilstudi/{nim}/{tahun}/{semester}/{kodenilai}", "Akademik@jamakcetakkartuhasilstudi")->name('jamakcetakkartuhasilstudi');
});
