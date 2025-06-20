<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $todos = [
             [
                'tugas' => 'Memberi makan ikan',
                'keterangan' => 'Ikan koi dan lele',
                'waktu_mulai' => '2025-06-01 05:20:20',
                'waktu_selesai' => '2025-06-12 05:20:20',
                'tugas_dari' => '1',
                'tugas_untuk' => '3',
            ],
            [
                'tugas' => 'Memberi makan ayam',
                'keterangan' => 'ayam merah dan kuning',
                'waktu_mulai' => '2025-06-01 05:20:12',
                'waktu_selesai' => '2025-06-18 05:20:12',
                'tugas_dari' => '2',
                'tugas_untuk' => '4',
            ],
            
        ];
        foreach ($todos as $todo) {
            Todo::create($todo);
        }
    }
}
