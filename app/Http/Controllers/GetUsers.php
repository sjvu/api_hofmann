<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GetUsers extends Controller
{
    public function GetUserApi()
    {
        $client = new Client();

        $urlApi = "https://test.drogueriahofmann.cl/usuarios/GetUsers";

        try {
            
            $response = $client->get($urlApi);

            $data = json_decode($response->getBody(), true);

            // print_r($data);

            return view('app', ['getUserss' => $data]);
        } catch (\Exception $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
    }
}
