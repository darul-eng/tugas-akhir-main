<?php

namespace App\GraphQL\Mutations;

use Softonic\GraphQL\ClientBuilder;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Symfony\Component\HttpKernel\Exception\HttpException;

use App\Repositories\AuthSister;

final class Authentication
{
    protected $authSister;

    public function __construct()
    {
        $this->authSister = new AuthSister;
    }

    public function login($_, array $args): String
    {
        $client = ClientBuilder::build('http://127.0.0.1:8001/graphql');

        $query = '
        mutation login($email: String!, $password: String!){
            login(email: $email, password: $password)
        }
        ';

        $variables = [
            'email' => $args['email'],
            'password' => $args['password']
        ];

        $response = $client->query($query, $variables);
        if (property_exists($response, 'errors') && $response->getErrors() != []) {
            return throw new HttpException(401, 'The provided credentials are incorrect.');
        }else{
            $result = $response->getData();
            return $result['login'];
            // return handleResponse($result['login'], 'Success');
        }
    }

    public function logout($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        if (array_key_exists('HTTP_AUTHORIZATION', $context->request()->server())) {
            $arrToken = explode(' ', $context->request()->server()['HTTP_AUTHORIZATION']);

            $valid = $this->authSister->verifyToken($arrToken[1]);

            if ($valid) {
                $client = ClientBuilder::build('http://127.0.0.1:8001/graphql');

                $query = '
                mutation logout($token: String!){
                    logout(token: $token){
                        id,
                        nama,
                        email
                    }
                }
                ';

                $variables = [
                    'token' => $arrToken[1]
                ];

                $response = $client->query($query, $variables);
                $result = $response->getData();
                // dd($result['logout']);
                return $result['logout'];
            } else {
                return throw new HttpException(401, 'Unauthorize');
            }
        } else {
            return throw new HttpException(401, 'Unauthorize');
        }
    }
}
