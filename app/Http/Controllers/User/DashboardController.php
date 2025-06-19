<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/todo";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        $penugas = User::where('role_id', 2)->get();
        $pelaksana = User::where('role_id', 3)->get();
        return view('user.dashboard', [
            'data' => $data,
            'penugas' => $penugas,
            'pelaksana' => $pelaksana
        ]);
    }

    public function show(string $id){
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/todo/$id";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        $pemberi = User::find($data['tugas_dari']);
        $penerima = User::find($data['tugas_untuk']);
        return view('user.show', [
            'data' => $data,
            'pemberi' => $pemberi,
            'penerima' => $penerima,
        ]);
    }
}
