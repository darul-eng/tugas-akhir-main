<?php

namespace App\Repositories;

use Softonic\GraphQL\ClientBuilder;
use Illuminate\Support\Facades\Http;

class AuthSister
{
    public function verifyToken(string $token)
    {
        $client = ClientBuilder::build('http://127.0.0.1:8001/graphql');

        $query = '
        mutation verify($token: String!){
            verify(token: $token)
        }
        ';

        $variables = [
            'token' => $token,
        ];

        $response = $client->query($query, $variables);

        $result = $response->getData();

        return $result['verify'];
    }

    public function verifyTokenRest(string $token)
    {
        $response = Http::post('http://127.0.0.1:8001/api/verify', [
            'token' => $token,
        ]);


        $result = $response->json();

        return $result['verify'];
    }
}