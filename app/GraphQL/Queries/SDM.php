<?php

namespace App\GraphQL\Queries;

use GraphQL\Client;
use GraphQL\Mutation;

use GraphQL\RawObject;

use App\Models\HumanResource;
use Illuminate\Support\Facades\Http;
use GraphQL\GraphQL as GraphQLGraphQL;
use PhpParser\Node\Expr\Cast\String_;

final class SDM
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // if (session()->has("graphql")) {
        //     $humanRecources = HumanResource::all();
        // }
        // $client = new Client(
        //     'http://127.0.0.1:8001/graphql',
        // );

        // $gql = '
        // mutation{
        //     login(email: "test@example.com", password: "password")
        // }';

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('http://127.0.0.1:8001/api/login', [
            'email' => "test@example.com",
            'password' => "password"
        ]);


        // $results = $client->runRawQuery($gql);
        // if (session()->has("graphql")) {
        //     $humanRecources = HumanResource::all();
        // }else{
        //     $response = GraphQLGraphQL::mutator('
        //         login(email:"test@example.com", password:"password")
        //     ')->get();
        //     // $string = 'tidak ada';
        // }
        // dd($results);
        
        return $response->json();
    }
}
