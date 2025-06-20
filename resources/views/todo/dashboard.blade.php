<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-light">
    <main class="container">
        <!-- START FORM -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action='' method='post'>
                @csrf
                @if (Route::current()->uri == 'todo/{id}')
                <a href="{{ url()->previous() }}" class="btn btn-outline-primary">Back</a>
                @method('put')
                @endif
                <div class="mb-3 row">
                    <label for="judul" class="col-sm-2 col-form-label">Tugas</label>
                    <div class="col-sm-10">
                        <input required value="{{ isset($data['tugas'])?$data['tugas']:old('tugas') }}" type="text" class="form-control" name='tugas' id="tugas">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <input required value="{{ isset($data['keterangan'])?$data['keterangan']:old('keterangan') }}" type="text" class="form-control" name='keterangan' id="keterangan">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggal_publikasi" class="col-sm-2 col-form-label">Start</label>
                    <div class="col-sm-10">
                        <input required value="{{ isset($data['waktu_mulai'])?$data['waktu_mulai']:old('waktu_mulai') }}" type="date" class="form-control w-50" name='waktu_mulai' id="waktu_mulai">
                    </div>
                </div>
                  <div class="mb-3 row">
                    <label for="tanggal_publikasi" class="col-sm-2 col-form-label">Deadline</label>
                    <div class="col-sm-10">
                        <input required value="{{ isset($data['waktu_selesai'])?$data['waktu_selesai']:old('waktu_selesai') }}" type="date" class="form-control w-50" name='waktu_selesai' id="waktu_selesai">
                    </div>
                </div>
                  <div class="mb-3 row">
                    <label for="tanggal_publikasi" class="col-sm-2 col-form-label">Penugas</label>
                    <div class="col-sm-10">
                        <select class="form-control w-50" name="tugas_dari" id="">
                            @foreach ($penugas as $user)
                            <option value="{{ $user->id }}"   {{ (isset($data['tugas_dari']) && $data['tugas_dari'] == $user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>  <div class="mb-3 row">
                    <label for="tanggal_publikasi" class="col-sm-2 col-form-label">Pelaksana</label>
                    <div class="col-sm-10">
                        <select class="form-control w-50" name="tugas_untuk" id="">
                            @foreach ($pelaksana as $user)
                            <option value="{{ $user->id }}"   {{ (isset($data['tugas_untuk']) && $data['tugas_untuk'] == $user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- AKHIR FORM -->

        @if (Route::current()->uri == 'todo')
            
        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-4">Judul</th>
                        <th class="col-md-3">Pengarang</th>
                        <th class="col-md-2">Tanggal Publikasi</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item['tugas'] }}</td>
                        <td>{{ $item['keterangan'] }}</td>
                        <td>{{ $item['waktu_mulai'] }}</td>
                        <td>
                            <a href="{{ url('todo/'.$item['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ url('todo/'.$item['id']) }}" method="post" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
        <!-- AKHIR DATA -->
        @endif
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>

</body>

</html>