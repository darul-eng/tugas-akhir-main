<?php

namespace App\Repositories;

use Softonic\GraphQL\ClientBuilder;

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

        // dd($response);

        $result = $response->getData();

        return $result['verify'];
    }
}