@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-blue-700">Data Pengguna</h1>
        <div class="flex space-x-3">
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition duration-200">
                <i class="fas fa-plus mr-2"></i>Tambah Data
            </button>
            <button class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 rounded-md transition duration-200">
                <i class="fas fa-download mr-2"></i>Export
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg overflow-hidden">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">No</th>
                    <th class="py-3 px-4 text-left">Tugas</th>
                    <th class="py-3 px-4 text-left">Keterangan</th>
                    <th class="py-3 px-4 text-left">Penugas</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-blue-100">
                <?php
                $idUser = Auth::user()->id
                ?>
                    @foreach ($data as $item)
                    @if ($item['tugas_untuk'] == $idUser)    
                    <?php $counter = 1; ?>
                    <tr class="hover:bg-blue-50 transition duration-150">
                        <td class="py-3 px-4">
                            <a href="{{ url('user/show/'.$item['id']) }}">
                              {{ $counter++ }}
                            </a>
                        </td>
                        <td class="py-3 px-4 font-medium">
                            <a href="{{ url('user/show/'.$item['id']) }}">
                                {{ $item['tugas'] }}</td>
                            </a>
                            <td class="py-3 px-4 text-blue-600">
                            <a href="{{ url('user/show/'.$item['id']) }}">
                            {{ $item['keterangan'] }}</td>
                        </a>
                        <td class="py-3 px-4">
                            <a href="{{ url('user/show/'.$item['id']) }}">
                            {{ $item['tugas_dari'] }}</td>
                        </a>
                        <td class="py-3 px-4">
                            <div class="flex justify-center space-x-2">
                                <button class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between items-center mt-6">
        <div class="text-sm text-blue-700">
            Menampilkan 1 sampai 10 dari 100 entri
        </div>
        <div class="flex space-x-1">
            <button class="px-3 py-1 rounded-md bg-blue-600 text-white">1</button>
            <button class="px-3 py-1 rounded-md bg-white text-blue-600 hover:bg-blue-50">2</button>
            <button class="px-3 py-1 rounded-md bg-white text-blue-600 hover:bg-blue-50">3</button>
            <button class="px-3 py-1 rounded-md bg-white text-blue-600 hover:bg-blue-50">Next</button>
        </div>
    </div>
</div>

<!-- Card Summary -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
        <h3 class="text-lg font-medium text-blue-700">Total Pengguna</h3>
        <p class="text-3xl font-bold text-blue-600 mt-2">1,248</p>
        <p class="text-sm text-blue-500 mt-1">+12% dari bulan lalu</p>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
        <h3 class="text-lg font-medium text-blue-700">Pengguna Aktif</h3>
        <p class="text-3xl font-bold text-green-600 mt-2">892</p>
        <p class="text-sm text-green-500 mt-1">+8% dari bulan lalu</p>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
        <h3 class="text-lg font-medium text-blue-700">Pengguna Baru</h3>
        <p class="text-3xl font-bold text-yellow-600 mt-2">156</p>
        <p class="text-sm text-yellow-500 mt-1">+5% dari bulan lalu</p>
    </div>
</div>
@endsection