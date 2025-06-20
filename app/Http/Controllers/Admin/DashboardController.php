<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::where('role_id', 3)->count();
        $totalSuperadmin = User::where('role_id', 1)->count();
        $totalAdmin = User::where('role_id', 2)->count();
        $totalSAdmin = $totalSuperadmin + $totalAdmin;
        return view('admin.dashboard', [
            'totalUser' => $totalUser,
            'totalAdmin' => $totalSAdmin
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
        return view('admin.show', [
            'data' => $data,
            'pemberi' => $pemberi,
            'penerima' => $penerima,
        ]);
    }

    public function add()
    {
        $penugas = User::where('role_id', 2)->get();
        $pelaksana = User::where('role_id', 3)->get();
        return view('admin.add', [
            'penugas' => $penugas,
            'pelaksana' => $pelaksana,
        ]);
    }

    public function store(Request $request)
    {
        $tugas = $request->tugas;
        $keterangan = $request->keterangan;
        $waktu_mulai = $request->waktu_mulai;
        $waktu_selesai = $request->waktu_selesai;
        $tugas_dari = $request->tugas_dari;
        $tugas_untuk = $request->tugas_untuk;

        $inputMulai = $request->waktu_mulai;
        $inputSelesai = $request->waktu_selesai;
        $datetimeMulai = new DateTime($inputMulai);
        $datetimeSelesai = new DateTime($inputSelesai);
        $formatMulai = $datetimeMulai->format('Y-m-d H:i:s'); 
        $formatSelesai = $datetimeSelesai->format('Y-m-d H:i:s'); 
        $parameter = [
            'tugas' => $tugas,
            'keterangan' => $keterangan,
            'waktu_mulai' => $formatMulai,
            'waktu_selesai' => $formatSelesai,
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
            return redirect()->to('admin/todo')->withErrors($error);
        } else {
            return redirect()->to('admin/todo')->with('success', 'Sukses!');
        }
    }
    public function todo()
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/todo";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        $penugas = User::where('role_id', 2)->get();
        $pelaksana = User::where('role_id', 3)->get();
        return view('admin.todo', [
            'data' => $data,
            'penugas' => $penugas,
            'pelaksana' => $pelaksana
        ]);
    }

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
            return view('admin.edit', [
                'data' => $data,
                'penugas' => $penugas,
                'pelaksana' => $pelaksana
            ]);
        }
    }

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
            return redirect()->to('admin/todo')->withErrors($error);
        } else {
            return redirect()->to('admin/todo')->with('success', 'Sukses Update Data!');
        }
    }

     public function destroy(string $id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/todo/$id";
        $response = $client->request('DELETE', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

    
        return redirect()->to('admin/todo')->with('success', 'Sukses Hapus Data!');
    }
}
