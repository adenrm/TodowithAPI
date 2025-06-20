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
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700' }}" :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-6 w-6 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="ml-3" x-show="!sidebarMinimized">Dashboard</span>
                <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Dashboard</div>
            </a>
            <div class="mt-8 px-3 pb-2" x-show="!sidebarMinimized">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Manajemen</h3>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-gray-100 {{ request()->routeIs('admin.users') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700' }}" :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-6 w-6 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span class="ml-3" x-show="!sidebarMinimized">Manajemen User</span>
                <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Manajemen User</div>
            </a>
            <a href="{{ route('admin.todo') }}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-gray-100 bg-indigo-50 text-indigo-700" :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-6 w-6 text-indigo-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="ml-3" x-show="!sidebarMinimized">Manajemen Todo</span>
                <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Manajemen Todo</div>
            </a>
            <div class="mt-8 px-3 pb-2" x-show="!sidebarMinimized">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Konfigurasi</h3>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-gray-100 {{ request()->routeIs('admin.settings') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700' }}" :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-6 w-6 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="space-y-8">
                          <a href="{{ url()->previous() }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
                            <table>
                                <tr>
                                    <td>
                                        Tugas :
                                    </td>
                                    <td>
                                        {{$data['tugas']}}
                                    </td>
                                </tr>
                                 <tr>
                                    <td>
                                        Keterangan :
                                    </td>
                                    <td>
                                        {{$data['keterangan']}}
                                    </td>
                                </tr>
                                 <tr>
                                    <td>
                                        Penugas :
                                    </td>
                                    <td>
                                        {{ $pemberi->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Pelaksana :
                                    </td>
                                    <td>
                                        {{ $penerima->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Start :
                                    </td>
                                    <td>
                                        {{ $data['waktu_mulai'] }}
                                    </td>
                                </tr>
                                  <tr>
                                    <td>
                                        Deadline :
                                    </td>
                                    <td>
                                        {{ $data['waktu_selesai'] }}
                                    </td>
                                </tr>
                            </table>
                    </div>
                </div>
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