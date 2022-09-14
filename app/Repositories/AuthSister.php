<?php

namespace App\Repositories;

use Softonic\GraphQL\ClientBuilder;
use Illuminate\Support\Facades\Http;

class AuthSister
{
    public function verifyToken(string $token)
    {
        $client = ClientBuilder::build('http://10.0.0.108/graphql');

        $query = '
        mutation verify($token: String!){
            verify(token: $token)
        }
        ';

        $variables = [
            'token' => $token,
        ];

        $response = $client->query($query, $variables);

        // dd($response);

        $result = $response->getData();

        return $result['verify'];
    }

    public function verifyTokenRest(string $token)
    {
        $response = Http::post('http://10.0.0.108/api/verify', [
            'token' => $token,
        ]);


        $result = $response->json();

        return $result['verify'];
    }
}