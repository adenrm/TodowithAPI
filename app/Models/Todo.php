<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $table = 'todo';
    protected $fillable = [
        'tugas',
        'keterangan',
        'waktu_mulai',
        'waktu_selesai',
        'tugas_dari',
        'tugas_untuk',
    ];
}
