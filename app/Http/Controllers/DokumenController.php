<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\AuthSister;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    protected $authSister;

    public function __construct()
    {
        $this->authSister = new AuthSister;
    }

    public function getByIDSdm(Request $request, $id_sdm)
    {
        if ($request->header('Authorization') != null) {
            $token = explode(' ', $request->header('Authorization'));
            $valid = $this->authSister->verifyTokenRest($token[1]);

            if ($valid) {
                // $dokumens = Dokumen::where('id_sdm', $request->id_sdm)->get();
                $dokumens = DB::table('dokumens')->where('id_sdm', '=', $id_sdm)->get();
                return handleResponse($dokumens, 'success');
            } else {
                return handleError('Unauthorized', [], 401);
            }
        } else {
            return handleError('Unauthorized', [], 401);
        }
    }

    public function uploadDokumenSDM(Request $request, $id_sdm)
    {
        if ($request->header('Authorization') != null) {
            $token = explode(' ', $request->header('Authorization'));
            $valid = $this->authSister->verifyTokenRest($token[1]);

            if ($valid) {
                $fileName = $request->file('file')->getClientOriginalName();
                $path = 'storage/rest/'. $fileName;

                $id_jenis_dokumen = 0;
                $jenis_dokumen = '';
                $nama = '';
                $keterangan = '';

                if ($request->id_jenis_dokumen) {
                    $id_jenis_dokumen = $request->id_jenis_dokumen;
                }

                if ($request->jenis_dokumen) {
                    $jenis_dokumen = $request->jenis_dokumen;
                }

                if ($request->nama) {
                    $nama = $request->nama;
                }

                if ($request->keterangan) {
                    $keterangan = $request->keterangan;
                }

                Storage::disk('public')->put('rest/' . $fileName, file_get_contents($request->file('file')->getRealPath()));
                DB::table('dokumens')->insert([
                    'id_dokumen' => Str::uuid(),
                    'id_sdm' => $id_sdm,
                    'tautan' => $path,
                    'id_jenis_dokumen' => $id_jenis_dokumen,
                    'jenis_dokumen' => $jenis_dokumen,
                    'nama' => $nama,
                    'keterangan' => $keterangan
                ]);
                // Dokumen::create([
                //     'id_dokumen' => Str::uuid(),
                //     'id_sdm' => $id_sdm,
                //     'dokumen' => $path,
                // ]);

                return handleResponse(['path' => $path], 'success');
            } else {
                return handleError('Unauthorized', [], 401);
            }
        } else {
            return handleError('Unauthorized', [], 401);
        }
    }
}
