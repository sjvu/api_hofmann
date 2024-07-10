<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UsersController extends Controller
{
    public function ListTableUsers()
    {
        $client = new Client();

        $urlListTableUsers = "https://test.drogueriahofmann.cl/usuarios/ListTableUsers";
        $urlGetUsers = "https://test.drogueriahofmann.cl/usuarios/GetUsers";

        try {
            
            $response = $client->get($urlListTableUsers);
            $response1 = $client->get($urlGetUsers);

            $data = json_decode($response->getBody(), true);
            $data1 = json_decode($response1->getBody(), true);

            // print_r($data);

            return view('app', ['usersList' => $data,'getUsers' => $data1]);
        } catch (\Exception $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
    }
}
