<?php

namespace App\GraphQL\Mutations;

use Error;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Softonic\GraphQL\ClientBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

final class Login
{
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
        $result = $response->getData();

        return $result['login'];
    }
}
