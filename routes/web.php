<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function(){
    // $response = Http::withHeaders([
    //     'Content-Type' => 'application/json',
    // ])->post('http://127.0.0.1:8001/api/login', [
    //     'email' => "test@example.com",
    //     'password' => "password"
    // ]);

    // $response = $response->json();
    // dd($response['token']);

    // env('API_KEY' , 'coba');
    config(['api.api_key' => 'tes']);

    dd(config('api.api_key'));

    // env('API_KEY', 'coba');
    // dd(env('API_KEY'));
        // dd(session('tesToken'));
    // $login = '
    //     mutation{
    //         login(email: "test@example.com", password: "password")
    //     }';

    // $loginResponse = Http::withHeaders([
    //     'Content-Type' => 'application/json',
    // ])->post('http://127.0.0.1:8001/graphql', [
    //     'query' => $login
    // ]);

    // $loginResponse = $loginResponse->json();
    // $token = $loginResponse['data']['login'];

    // $me = '
    //         query{
    //             me{
    //                 name,
    //                 email
    //                 }
    //             }';

    // $response = Http::withHeaders([
    //     'Content-Type' => 'application/json',
    //     'Authorization' => "Bearer $token"
    // ])->post('http://127.0.0.1:8001/graphql', [
    //     'query' => $me
    // ]);

    // dd($response->getContent());
    // $response = $response->json();
    // dd($response['data']['me']);
    // dd($response['data']['login']);
});
