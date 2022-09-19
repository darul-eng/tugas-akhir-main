<?php

namespace App\GraphQL\Queries;

use App\Repositories\AuthSister;
use Illuminate\Support\Facades\DB;
use GraphQL\Type\Definition\ResolveInfo;

use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\Models\FormalEducation as ModelsFormalEducation;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class FormalEducation
{
    protected $authSister;

    public function __construct()
    {
        $this->authSister = new AuthSister;
    }

    public function all($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        if (array_key_exists('HTTP_AUTHORIZATION', $context->request()->server())) {
            $arrToken = explode(' ', $context->request()->server()['HTTP_AUTHORIZATION']);

            $valid = $this->authSister->verifyToken($arrToken[1]);

            if ($valid) {
                // return ModelsFormalEducation::all();
                return DB::table('formal_education')->get();
            } else {
                return throw new HttpException(401, 'Unauthorize');
            }
        } else {
            return throw new HttpException(401, 'Unauthorize');
        }
    }

    public function byID($_, array $args, GraphQLContext $context)
    {
        if (array_key_exists('HTTP_AUTHORIZATION', $context->request()->server())) {
            $arrToken = explode(' ', $context->request()->server()['HTTP_AUTHORIZATION']);

            $valid = $this->authSister->verifyToken($arrToken[1]);

            if ($valid) {
                // return ModelsFormalEducation::where('id_sdm', $args['id_sdm'])->get();
                return DB::table('formal_education')->where('id_sdm', '=', $args['id_sdm'])->get();
            } else {
                return throw new HttpException(401, 'Unauthorize');
            }
        }else{
            return throw new HttpException(401, 'Unauthorize');
        }
    }
}
