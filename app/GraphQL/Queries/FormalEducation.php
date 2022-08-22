<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Symfony\Component\HttpKernel\Exception\HttpException;

use App\Models\FormalEducation as ModelsFormalEducation;
use App\Repositories\AuthSister;

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
                return ModelsFormalEducation::all();
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
                return ModelsFormalEducation::where('id_sdm', $args['id_sdm'])->get();
            } else {
                return throw new HttpException(401, 'Unauthorize');
            }
        }else{
            return throw new HttpException(401, 'Unauthorize');
        }
    }
}
