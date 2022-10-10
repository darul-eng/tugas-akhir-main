<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormalEducation;
use App\Repositories\AuthSister;
use Illuminate\Support\Facades\DB;

class FormalEducationController extends Controller
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
                // $formalEducations = FormalEducation::all();
                $formalEducations = DB::table('formal_education')->get();
                return handleResponse($formalEducations, 'success');
            } else {
                return handleError('Unauthorized', [], 401);
            }
        } else {
            return handleError('Unauthorized', [], 401);
        }
    }

    public function getByIDSdm(Request $request, $id_sdm)
    {
        if ($request->header('Authorization') != null) {
            $token = explode(' ', $request->header('Authorization'));
            $valid = $this->authSister->verifyTokenRest($token[1]);

            if ($valid) {
                $formalEducations = FormalEducation::where('id_sdm', $id_sdm)->get();
                // $formalEducations = DB::table('formal_education')->where('id_sdm', '=', $id_sdm)->get();
                return handleResponse($formalEducations, 'success');
            } else {
                return handleError('Unauthorized', [], 401);
            }
        } else {
            return handleError('Unauthorized', [], 401);
        }
    }
}
