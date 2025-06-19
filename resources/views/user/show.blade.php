@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <table>
        <tr>
            <td>
                Judul : {{$data['tugas']}}
            </td>
        </tr>
        <tr>
            <td>
                Keterangan : {{ $data['keterangan'] }}
            </td>
        </tr>
        <tr>
            <td>
                Pemberi : {{ $pemberi->name }}
            </td>
        </tr>
        <tr>
            <td>
                Penerima : {{ $penerima->name }}
            </td>
        </tr>
        <tr>
            <td>
                Jangka Waktu : {{ $data['waktu_mulai'].' - '.$data['waktu_selesai'] }}
            </td>
        </tr>
    </table>
    </div>

    
@endsection