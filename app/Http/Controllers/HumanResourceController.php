<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HumanResource;
use App\Repositories\AuthSister;
use Illuminate\Support\Facades\DB;

class HumanResourceController extends Controller
{
    protected $authSister;

    public function __construct()
    {
        $this->authSister = new AuthSister;
    }

    public function getAll(Request $request)
    {
        if ($request->header('Authorization') != null) {
            $token = explode(' ', $request->header('Authorization'));
            $valid = $this->authSister->verifyTokenRest($token[1]);

            if ($valid) {
                // $humanResources = HumanResource::with(['pendidikan_formal', 'dokumen'])->get();
                // $humanResources = DB::table('human_resources')->join('formal_education', 'human_resources.id_sdm', '=', 'formal_education.id_sdm')->get();
                $humanResources = DB::table('human_resources')->get();
                return handleResponse($humanResources, 'success');
            }else{
                return handleError('Unauthorized', [], 401);
            }
        }else{
            return handleError('Unauthorized', [], 401);
        }
    }

    public function getByID(Request $request, $id_sdm)
    {
        // dd($id_sdm);
        if ($request->header('Authorization') != null) {
            $token = explode(' ', $request->header('Authorization'));
            $valid = $this->authSister->verifyTokenRest($token[1]);

            if ($valid) {
                // $humanResources = HumanResource::where('id_sdm', $id_sdm)->first();
                $humanResources = DB::table('human_resources')->where('id_sdm', '=', $id_sdm)->first();
                return handleResponse($humanResources, 'success');
            } else {
                return handleError('Unauthorized', [], 401);
            }
        } else {
            return handleError('Unauthorized', [], 401);
        }
    }
}
