<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('todo', function (Blueprint $table) {
            $table->id();
            $table->string('tugas');
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->foreignId('tugas_dari')->constrained('users')->onDelete('cascade');
            $table->foreignId('tugas_untuk')->constrained('users')->onDelete('cascade');
            $table->string('keterangan');
            $table->timestamps();
        });

        Schema::create('hasiltugas', function (Blueprint $table) {
            $table->foreignId('id')->constrained('todo')->onDelete('cascade');
            $table->time('tanggal_pembaruan');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
        Schema::dropIfExists('todo');
        Schema::dropIfExists('hasiltugas');
        Schema::dropIfExists('login');
    }
};
