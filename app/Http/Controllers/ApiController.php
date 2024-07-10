<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function enviarDatos(Request $request)
    {
        $urlListTableUsers = "https://test.drogueriahofmann.cl/usuarios/SendUser";

        $datos = [
            'id' => $request->input('id'),
            'code' => $request->input('code'),
            'amount' => $request->input('amount'),
            'date' => $request->input('date'),
            'github' => "https://github.com/sjvu/api_hofmann",
        ];
        // echo json_encode($datos);
        
        $response = Http::withBody(
            json_encode($datos)
        )->post($urlListTableUsers);

        if ($response->successful()) {
            return redirect()->back()->with('success', $response->status());
        } else {
            return redirect()->back()->with('error', 'Hubo un problema al enviar los datos '.$response->status());
        }
    }
}
