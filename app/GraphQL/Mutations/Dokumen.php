<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Dokumen as Model;
use App\Repositories\AuthSister;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
                $dokumen = DB::table('dokumens')->get();
                // $dokumen = Model::all();
                return $dokumen;
            } else {
                return throw new HttpException(401, 'Unauthorize');
            }
        } else {
            return throw new HttpException(401, 'Unauthorize');
        }
    }

    public function byIDSdm($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        if (array_key_exists('HTTP_AUTHORIZATION', $context->request()->server())) {
            $arrToken = explode(' ', $context->request()->server()['HTTP_AUTHORIZATION']);

            $valid = $this->authSister->verifyToken($arrToken[1]);

            if ($valid) {
                $dokumen = DB::table('dokumens')->where('id_sdm', '=', $args['id_sdm'])->get();
                // $dokumen = Model::where('id_sdm', $args['id_sdm'])->get();
                return $dokumen;
            } else {
                return throw new HttpException(401, 'Unauthorize');
            }
        } else {
            return throw new HttpException(401, 'Unauthorize');
        }
    }

    public function uploadDokumen($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        // this code is not working if tes with apache jmeter di beberapa waktu
        // if (array_key_exists('HTTP_AUTHORIZATION', $context->request()->server())) {
        //     $arrToken = explode(' ', $context->request()->server()['HTTP_AUTHORIZATION']);

        //     $valid = $this->authSister->verifyToken($arrToken[1]);

        //     if ($valid) {
        //         dd($args['file']);
        //         $fileName = $args['file']->hashName();
        //         $path = 'storage/graphql/' . $fileName;

        //         Storage::disk('public')->put('graphql/' . $fileName, file_get_contents($args['file']));
        //         Model::create([
        //             'id_dokumen' => Str::uuid(),
        //             'id_sdm' => $args['id_sdm'],
        //             'dokumen' => $path
        //         ]);

        //         return $path;
        //     } else {
        //         return throw new HttpException(401, 'Unauthorize');
        //     }
        // } else {
        //     if (array_key_exists('HTTP_AUTHORIZATION_', $context->request()->server())) {
        //         $response = $context->request()->server('HTTP_AUTHORIZATION_');
        //         $response = substr($response, strpos($response, " ") + 1);
        //         echo $response;
        //         // return $context->request()->server()['HTTP_AUTHORIZATION_'];
        //     }
        //     return throw new HttpException(401, 'Unauthorize');
        // }

        if (array_key_exists('HTTP_AUTHORIZATION', $context->request()->server())) {
            $response = $context->request()->server('HTTP_AUTHORIZATION');
            $token = substr($response, strpos($response, " ") + 1);

            $valid = $this->authSister->verifyToken($token);

            if ($valid) {
                $fileName = $args['file']->hashName();
                $path = 'storage/graphql/' . $fileName;

                $id_jenis_dokumen = 0;
                $jenis_dokumen = '';
                $nama = '';
                $keterangan = '';

                if (array_key_exists('id_jenis_dokumen', $args)) {
                    $id_jenis_dokumen = $args['id_jenis_dokumen'];
                }

                if (array_key_exists('jenis_dokumen', $args)) {
                    $jenis_dokumen = $args['jenis_dokumen'];
                }

                if (array_key_exists('nama', $args)) {
                    $nama = $args['nama'];
                }

                if (array_key_exists('keterangan', $args)) {
                    $keterangan = $args['keterangan'];
                }
                Storage::disk('public')->put('graphql/' . $fileName, file_get_contents($args['file']));
                DB::table('dokumens')->insert([
                    'id_dokumen' => Str::uuid(),
                    'id_sdm' => $args['id_sdm'],
                    'tautan' => $path,
                    'id_jenis_dokumen' => $id_jenis_dokumen,
                    'jenis_dokumen' => $jenis_dokumen,
                    'nama' => $nama,
                    'keterangan' => $keterangan
                ]);
                // Model::create([
                //     'id_dokumen' => Str::uuid(),
                //     'id_sdm' => $args['id_sdm'],
                //     'dokumen' => $path
                // ]);

                return $path;
            } else {
                return throw new HttpException(401, 'Unauthorize');
            }
        } else {
            return throw new HttpException(401, 'Unauthorize');
        }
    }

}
