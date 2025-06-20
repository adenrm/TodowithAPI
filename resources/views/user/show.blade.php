@extends('layouts.app')

@section('content')
<a href="{{ url()->previous() }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
<div class="bg-white rounded-lg shadow-md mt-5 p-6">
    <table>
        <tr>
            <td>
                Judul
            </td>
            <td>
                :
            </td>
            <td>
                {{$data['tugas']}}
            </td>
        </tr>
        <tr>
            <td>
                Keterangan
            </td>
            <td>
                :
            </td>
            <td>
                {{ $data['keterangan'] }}
            </td>
        </tr>
        <tr>
            <td>
                Pemberi
            </td>
            <td>
                :
            </td>
            <td>
                {{ $pemberi->name }}
            </td>
        </tr>
        <tr>
            <td>
                Penerima 
            </td>
            <td>
                :
            </td>
            <td>
                {{ $penerima->name }}
            </td>
        </tr>
        <tr>
            <td>
                 <?php
                            $dateString = $data['waktu_selesai'];
                            $dateStrings = $data['waktu_mulai'];
                            $dateStart = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dateStrings);
                            $dateEnd = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dateString);
                            ?>
                Di Tugaskan Pada
            </td>
            <td>
                :
            </td>
            <td>
                {{ $dateStart->format('d M Y') }}
            </td>
        </tr>
        <tr>
            <td>
                Sisa Waktu
            </td>
            <td>
                :
            </td>
            <td>
                {{ $dateEnd->diffForHumans() }}
            </td>
        </tr>
    </table>
    </div>

    
@endsection