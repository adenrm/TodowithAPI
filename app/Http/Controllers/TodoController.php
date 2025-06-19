<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/todo";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        $penugas = User::where('role_id', 1)->get();
        $pelaksana = User::where('role_id', 3)->get();
        return view('todo.index', [
            'data' => $data,
            'penugas' => $penugas,
            'pelaksana' => $pelaksana
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tugas = $request->tugas;
        $keterangan = $request->keterangan;
        $waktu_mulai = $request->waktu_mulai;
        $waktu_selesai = $request->waktu_selesai;
        $tugas_dari = $request->tugas_dari;
        $tugas_untuk = $request->tugas_untuk;

        $parameter = [
            'tugas' => $tugas,
            'keterangan' => $keterangan,
            'waktu_mulai' => $waktu_mulai,
            'waktu_selesai' => $waktu_selesai,
            'tugas_dari' => $tugas_dari,
            'tugas_untuk' => $tugas_untuk
        ];

        $client = new Client();
        $url = "http://127.0.0.1:8000/api/todo";
        $response = $client->request('POST', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if ($contentArray['status'] != true) {
            $message = $contentArray['message'];
            $error = $contentArray['errors'];
            return redirect()->to('todo')->withErrors($error);
        } else {
            return redirect()->to('todo')->with('success', 'Sukses!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

      /**
     * Show form edit for editing the specified resource in storage.
     */
    public function edit(string $id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/todo/$id";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            $error = $contentArray['message'];
            return redirect()->to('todo')->withErrors($error);
        } else {
            $data = $contentArray['data'];
            $penugas = User::where('role_id', 1)->get();
            $pelaksana = User::where('role_id', 3)->get();
            return view('todo.index', [
                'data' => $data,
                'penugas' => $penugas,
                'pelaksana' => $pelaksana
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tugas = $request->tugas;
        $keterangan = $request->keterangan;
        $waktu_mulai = $request->waktu_mulai;
        $waktu_selesai = $request->waktu_selesai;
        $tugas_dari = $request->tugas_dari;
        $tugas_untuk = $request->tugas_untuk;

        $parameter = [
            'tugas' => $tugas,
            'keterangan' => $keterangan,
            'waktu_mulai' => $waktu_mulai,
            'waktu_selesai' => $waktu_selesai,
            'tugas_dari' => $tugas_dari,
            'tugas_untuk' => $tugas_untuk
        ];

        $client = new Client();
        $url = "http://127.0.0.1:8000/api/todo/$id";
        $response = $client->request('PUT', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if ($contentArray['status'] != true) {
            $message = $contentArray['message'];
            $error = $contentArray['errors'];
            return redirect()->to('todo')->withErrors($error);
        } else {
            return redirect()->to('todo')->with('success', 'Sukses Update Data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/todo/$id";
        $response = $client->request('DELETE', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

    
        return redirect()->to('todo')->with('success', 'Sukses Hapus Data!');
    }
}
