<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Str;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Symfony\Component\HttpKernel\Exception\HttpException;

use App\Repositories\AuthSister;
use App\Models\Dokumen as Model;

final class Dokumen
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
                $dokumen = Model::all();
                return $dokumen;
            } else {
                return throw new HttpException(401, 'Unauthorize');
            }
        } else {
            return throw new HttpException(401, 'Unauthorize');
        }
    }

    public function uploadDokumen($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): ?string
    {
        if (array_key_exists('HTTP_AUTHORIZATION', $context->request()->server())) {
            $arrToken = explode(' ', $context->request()->server()['HTTP_AUTHORIZATION']);

            $valid = $this->authSister->verifyToken($arrToken[1]);

            if ($valid) {
                $file = $args['file'];
                $path = $file->storePublicly('public/dokumens');
                Model::create([
                    'id_dokumen' => Str::uuid(),
                    'id_sdm' => $args['id_sdm'],
                    'dokumen' => $path
                ]);

                return $path;
            } else {
                return throw new HttpException(401, 'Unauthorize');
            }
        } else {
            return throw new HttpException(401, 'Unauthorize');
        }
    }

}
