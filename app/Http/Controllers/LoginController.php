<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //
    public function index()
    {

        $title = "Akademik SIAKAD UMUKA";
        return view('auth/login', compact('title'));
    }

    public function index2()
    {
        $title = "Akademik SIAKAD UMUKA - Gen Z Dark Mode";
        return view('auth/login2', compact('title'));
    }

    public function make_session_pegawai(Request $request)
    {

        Session::put('session_tahun', $request->tahun);
        Session::put('session_semester', $request->semester);
        Session::put('session_nama_tahunakademik', $request->tahun_ajaran);
        Session::put('tipe', 'Pegawai');
        Session::put('username', $request->username);
        Session::put('nama', $request->nama);
        Session::put('jabatan', $request->jabatan);
        Session::put('nm_module', $request->nm_module);
        Session::put('kode_fakultas', $request->kode_fakultas);
        Session::put('token', $request->token);

        return true;
    }


    public function make_session_mahasiswa(Request $request)
    {


        Session::put('session_tahun', $request->tahun);
        Session::put('session_semester', $request->semester);
        Session::put('session_nama_tahunakademik', $request->tahun_ajaran);
        Session::put('tipe', 'Mahasiswa');
        Session::put('username', $request->username);
        Session::put('gender', $request->gender);
        Session::put('nama', $request->nama);
        Session::put('kode_program_studi', $request->kode_program_studi);
        Session::put('kode_penilaian', $request->kode_penilaian);
        Session::put('id_mhs', $request->id_mhs);
        Session::put('id_mreg', $request->id_mreg);
        Session::put('token', $request->token);

        return true;
    }

    public function make_session_dosen(Request $request)
    {

        Session::put('session_tahun', $request->tahun);
        Session::put('session_semester', $request->semester);
        Session::put('session_nama_tahunakademik', $request->tahun_ajaran);
        Session::put('tipe', 'Dosen');
        Session::put('username', $request->username);
        Session::put('nama', $request->nama);
        Session::put('kode_program_studi', $request->kode_program_studi);
        Session::put('nama_program_studi', $request->nama_program_studi ?: '');
        Session::put('homebase_prodi', $request->homebase_prodi ?: $request->kode_program_studi);
        Session::put('dosen_wali', $request->dosen_wali);
        Session::put('kaprodi', $request->kaprodi);
        Session::put('id_dosen', $request->id_dosen);
        Session::put('nidn', $request->nidn);
        Session::put('token', $request->token);

        // RBAC Context
        $kaprodiList = is_string($request->kaprodi_list) ? json_decode($request->kaprodi_list, true) : ($request->kaprodi_list ?: []);
        $dekanList = is_string($request->dekan_list) ? json_decode($request->dekan_list, true) : ($request->dekan_list ?: []);
        
        Session::put('is_kaprodi', (int)$request->is_kaprodi);
        Session::put('kaprodi_list', $kaprodiList ?: []);
        Session::put('is_dekan', (int)$request->is_dekan);
        Session::put('dekan_list', $dekanList ?: []);

        // Jika nama_program_studi belum terisi dan kaprodi_list ada, ambil nama dari kaprodi_list
        if (empty(Session::get('nama_program_studi')) && !empty($kaprodiList)) {
            $curr = collect($kaprodiList)->firstWhere('kode_program_studi', $request->kode_program_studi);
            if ($curr && !empty($curr['nama_program_studi'])) {
                Session::put('nama_program_studi', $curr['nama_program_studi']);
            }
        }

        return true;
    }

    public function switch_prodi(Request $request)
    {
        $targetKode = $request->kode_prodi;
        $kaprodiList = Session::get('kaprodi_list', []);

        if (empty($kaprodiList) || count($kaprodiList) <= 1) {
            $idDosen = Session::get('id_dosen') ?: Session::get('id_pegawai');
            if (!$idDosen && Session::get('username')) {
                try {
                    $uD = DB::table('user_dosen')->where('email_login', Session::get('username'))->first();
                    if ($uD) {
                        $idDosen = $uD->id_pegawai;
                        Session::put('id_dosen', $idDosen);
                    }
                } catch (\Exception $e) {}
            }
            if ($idDosen) {
                try {
                    $dbRoles = DB::table('akd_pegawai_role')
                        ->where('id_pegawai', $idDosen)
                        ->where('role_code', 'kaprodi')
                        ->where('is_active', 1)
                        ->where(function ($q) {
                            $q->whereNull('tgl_selesai')->orWhere('tgl_selesai', '>=', date('Y-m-d'));
                        })
                        ->get();
                    if ($dbRoles->isNotEmpty()) {
                        $prodiMap = DB::table('akd_program_studi')
                            ->whereIn('kode_program_studi', $dbRoles->pluck('unit_id')->toArray())
                            ->get()
                            ->keyBy('kode_program_studi');
                        $kaprodiList = [];
                        foreach ($dbRoles as $dr) {
                            $pObj = $prodiMap->get($dr->unit_id);
                            $kaprodiList[] = [
                                'kode_program_studi' => $dr->unit_id,
                                'nama_program_studi' => $pObj ? $pObj->nama_program_studi : $dr->unit_id,
                                'role_code'          => 'kaprodi',
                                'status_jabatan'     => $dr->status_jabatan,
                                'is_primary'         => (int)$dr->is_primary
                            ];
                        }
                        Session::put('kaprodi_list', $kaprodiList);
                        Session::put('is_kaprodi', 1);
                    }
                } catch (\Exception $e) {}
            }
        }

        if (empty($kaprodiList)) {
            return response()->json([
                'status'  => false,
                'message' => 'Anda tidak terdaftar sebagai Kaprodi pada program studi manapun!'
            ], 403);
        }

        $found = collect($kaprodiList)->firstWhere('kode_program_studi', $targetKode);
        if ($found) {
            Session::put('kode_program_studi', $found['kode_program_studi']);
            Session::put('nama_program_studi', $found['nama_program_studi']);
            Session::put('status_jabatan_prodi', $found['status_jabatan'] ?? 'definitif');

            return response()->json([
                'status'  => true,
                'message' => 'Berhasil beralih ke Program Studi ' . $found['nama_program_studi'] . ' (' . $found['kode_program_studi'] . ')',
                'data'    => $found
            ]);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Program studi tidak valid atau Anda tidak memiliki akses ke program studi ini!'
        ], 403);
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}
