<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();
        if (empty ($todos)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ada!',
                'data' => 'null'
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data di temukan!',
                'data' => $todos
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tugas' => 'required',
            'keterangan' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'tugas_dari' => 'required',
            'tugas_untuk' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $todo = Todo::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Tugas berhasil di tambahkan!',
            'data' => $todo,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $todo = Todo::find($id);
    if ($todo['id'] == $id) {
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan!',
            'data' => $todo
        ]);
    }

        return response()->json([
            'status' => false,
            'message' => 'Data tidak ada!'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validator = Validator::make($request->all(), [
            'tugas' => 'required',
            'keterangan' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'tugas_dari' => 'required',
            'tugas_untuk' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $todo = Todo::findOrFail($id);
        $todo->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Tugas berhasil di update!',
            'data' => $todo,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil di hapus!',
        ], 204);
    }
}
