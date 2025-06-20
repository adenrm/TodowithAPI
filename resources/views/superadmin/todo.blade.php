@extends('layouts.superadmin')

@section('title', 'Dashboard')

@section('content')
<div x-data="{ 
    sidebarOpen: false,
    sidebarMinimized: localStorage.getItem('sidebarMinimized') === 'true',
    toggleSidebar() {
        this.sidebarMinimized = !this.sidebarMinimized;
        localStorage.setItem('sidebarMinimized', this.sidebarMinimized);
    }
}" class="flex h-screen bg-gray-50 overflow-hidden">
    <aside :class="{
            'w-64': !sidebarMinimized,
            'w-28': sidebarMinimized,
            'translate-x-0': sidebarOpen,
            '-translate-x-full lg:translate-x-0': !sidebarOpen
        }" 
        class="fixed inset-y-0 left-0 z-50 flex flex-col transition-all duration-300 ease-in-out bg-white border-r border-gray-200 lg:relative">
        <div class="flex items-center justify-between h-16 bg-indigo-700">
            <a href="{{ route('superadmin.dashboard') }}" class="flex items-center" :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-8 w-8 text-white mx-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="text-white text-xl font-bold" x-show="!sidebarMinimized">SuperAdmin</span>
            </a>
            <button @click="toggleSidebar" class="p-2 text-white hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-40 lg:block hidden mr-2">
                <svg x-show="!sidebarMinimized" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
                <svg x-show="sidebarMinimized" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </button>
        </div>
        <div class="flex items-center px-4 py-5 border-b border-gray-200" x-show="!sidebarMinimized">
            <div class="flex-shrink-0">
                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                    <span class="text-lg font-medium text-indigo-600">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</span>
                </div>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'Administrator' }}</p>
                <p class="text-xs font-medium text-gray-500">Super Administrator</p>
            </div>
        </div>
        <div class="flex justify-center py-5 border-b border-gray-200" x-show="sidebarMinimized" x-cloak>
            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                <span class="text-lg font-medium text-indigo-600">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</span>
            </div>
        </div>
        <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
            <div class="px-3 pb-2" x-show="!sidebarMinimized">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Menu Utama</h3>
            </div>
            <a href="{{ route('superadmin.dashboard') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-gray-100 {{ request()->routeIs('superadmin.dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700' }}" :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-6 w-6 {{ request()->routeIs('superadmin.dashboard') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="ml-3" x-show="!sidebarMinimized">Dashboard</span>
                <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Dashboard</div>
            </a>
            <div class="mt-8 px-3 pb-2" x-show="!sidebarMinimized">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Manajemen</h3>
            </div>
            <a href="{{ route('superadmin.dashboard') }}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-gray-100 {{ request()->routeIs('superadmin.users') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700' }}" :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-6 w-6 {{ request()->routeIs('superadmin.dashboard') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span class="ml-3" x-show="!sidebarMinimized">Manajemen User</span>
                <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Manajemen User</div>
            </a>
            <a href="{{ route('superadmin.todo') }}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-gray-100 {{ request()->routeIs('superadmin.todo') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700' }}" :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-6 w-6 {{ request()->routeIs('superadmin.todo') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="ml-3" x-show="!sidebarMinimized">Manajemen Todo</span>
                <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Manajemen Todo</div>
            </a>
            <div class="mt-8 px-3 pb-2" x-show="!sidebarMinimized">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Konfigurasi</h3>
            </div>
            <a href="{{ route('superadmin.dashboard') }}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-gray-100 {{ request()->routeIs('superadmin.settings') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700' }}" :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-6 w-6 {{ request()->routeIs('superadmin.dashboard') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="ml-3" x-show="!sidebarMinimized">Pengaturan</span>
                <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Pengaturan</div>
            </a>
            <div class="px-3 mt-8">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="group flex w-full items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-red-50 text-gray-700 hover:text-red-700" :class="{ 'justify-center': sidebarMinimized }">
                        <svg class="h-6 w-6 text-gray-500 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="ml-3" x-show="!sidebarMinimized">Logout</span>
                        <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Logout</div>
                    </button>
                </form>
            </div>
        </nav>
    </aside>
    <div class="flex-1 flex flex-col min-h-screen overflow-x-hidden" :class="{ 'lg:ml-0': !sidebarMinimized, 'lg:ml-0': sidebarMinimized }">
        <header class="sticky top-0 z-10 bg-white shadow">
            <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                <button @click="sidebarOpen = !sidebarOpen" type="button" class="lg:hidden text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-md p-1">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div class="flex-1 px-4 flex justify-between">
                    <div class="flex-1">
                        <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
                    </div>
                </div>
            </div>
        </header>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="space-y-8">
                       
                        <!-- Table -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <a href="{{url('superadmin/add')}}" class=" focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Tambah
        </a>
        <div class="overflow-x-auto mt-5">
            <table class="min-w-full bg-white rounded-lg overflow-hidden">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">No</th>
                        <th class="py-3 px-4 text-left">Tugas</th>
                        <th class="py-3 px-4 text-left">Keterangan</th>
                        <th class="py-3 px-4 text-left">Penugas</th>
                        <th class="py-3 px-4 text-left">Pelaksana</th>
                        <th class="py-3 px-4 text-left">Start</th>
                        <th class="py-3 px-4 text-left">Deadline</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-100">
                    @foreach ($data as $item)
                    <tr class="hover:bg-blue-50 transition duration-150">
                        <td class="py-3 px-4">
                                <a href="{{ url('superadmin/show/'.$item['id']) }}">
                                {{ $loop->iteration }}
                                </a>
                            </td>
                        <td class="py-3 px-4 font-medium">
                            <a href="{{ url('superadmin/show/'.$item['id']) }}">
                            {{ $item['tugas'] }}
                            </a>
                        </td>
                        <td class="py-3 px-4 text-blue-600">
                            <a href="{{ url('superadmin/show/'.$item['id']) }}">    
                            {{ $item['keterangan'] }}
                            </a>
                        </td>
                        <td class="py-3 px-4">
                            <?php
                            $penugasnya = App\Models\User::find($item['tugas_dari']);
                            ?>
                            <a href="{{ url('superadmin/show/'.$item['id']) }}">
                            {{ $penugasnya->name }}
                            </a>
                        </td>
                         <td class="py-3 px-4">
                            <?php
                            $pelaksananya = App\Models\User::find($item['tugas_untuk']);
                            ?>
                            <a href="{{ url('superadmin/show/'.$item['id']) }}">
                            {{ $pelaksananya->name }}
                            </a>
                        </td>
                        <td class="py-3 px-4">
                            <?php
                            $dateString = $item['waktu_mulai'];
                            $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dateString);
                            ?>
                            <a href="{{ url('superadmin/show/'.$item['id']) }}">
                            {{ $date->diffForHumans() }}
                            </a>
                        </td>
                           <td class="py-3 px-4">
                           <?php
                            $dateString = $item['waktu_selesai'];
                            $dateEnd = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dateString);
                            ?>
                            <a href="{{ url('superadmin/show/'.$item['id']) }}">
                            {{ $dateEnd->diffForHumans() }}
                            </a>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex justify-center space-x-2">
                                <a class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ url('superadmin/todo/'.$item['id']) }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                    Edit
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ url('todo/'.$item['id']) }}" method="post" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="d-inline">
                                    @csrf
                                    @method('delete')
                                <button type="submit" name="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Del</button>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
    </div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- <script>
    // const ctx = document.getElementById('activityChart').getContext('2d');
    // new Chart(ctx, {
    //     type: 'line',
    //     data: {
    //         labels: {!! json_encode($chartLabels) !!},
    //         datasets: [{
    //             label: 'Aktivitas Pengguna',
    //             data: {!! json_encode($chartData) !!},
    //             borderColor: 'rgb(59, 130, 246)',
    //             tension: 0.4
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         maintainAspectRatio: false,
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });
</script> --}}
@endpush
@endsection 