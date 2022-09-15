<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\AuthSister;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    protected $authSister;

    public function __construct()
    {
        $this->authSister = new AuthSister;
    }

    public function getByIDSdm(Request $request)
    {
        if ($request->header('Authorization') != null) {
            $token = explode(' ', $request->header('Authorization'));
            $valid = $this->authSister->verifyTokenRest($token[1]);

            if ($valid) {
                $humanResources = Dokumen::where('id_sdm', $request->id_sdm)->get();
                return handleResponse($humanResources, 'success');
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
                $fileName = $request->file->hashName();
                $path = 'storage/rest/'. $fileName;

                Storage::disk('public')->put('rest/' . $fileName, file_get_contents($request->file('file')));
                Dokumen::create([
                    'id_dokumen' => Str::uuid(),
                    'id_sdm' => $id_sdm,
                    'dokumen' => $path,
                ]);

                return handleResponse(['path' => $path], 'success');
            } else {
                return handleError('Unauthorized', [], 401);
            }
        } else {
            return handleError('Unauthorized', [], 401);
        }
    }
}
