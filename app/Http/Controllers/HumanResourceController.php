<?php

namespace App\Http\Controllers;

use App\Models\HumanResource;
use Illuminate\Http\Request;
use App\Repositories\AuthSister;

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
                $humanResources = HumanResource::all();
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
                $humanResources = HumanResource::where('id_sdm', $id_sdm)->first();
                return handleResponse($humanResources, 'success');
            } else {
                return handleError('Unauthorized', [], 401);
            }
        } else {
            return handleError('Unauthorized', [], 401);
        }
    }
}
