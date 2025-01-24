@extends('dashboard.dashboard')
@section('title', 'Data Siswa')
@section('content')
    <h1 class="text-center mb-3">Data Siswa</h1>
    <div class="col-4 col-md-4 mb3">
        <form action="{{ url('/siswa') }}" method="get">
            <div class="input-group mb-3">
                <input type="text" name="cari" id="cari" class="form-control" value="{{ request('cari') }}">
                <button class="btn btn-primary">cari</button>
                <a href="{{ url('/siswa') }}" class="btn btn-danger">batal</a>
            </div>
        </form>
    </div>
    <hr>
    <div class="table-responsif ">
        <table class="table table-hover table-striped table-bordered">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>Nik</th>
                    <th>Nisn</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Pekerjaan</th>
                    <th>Foto</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $value)
                    <tr>
                        <td>{{ $data->firstItem() + $key }}</td>
                        <td>{{ $value->nik }} </td>
                        <td>{{ $value->nisn }}</td>
                        <td>{{ $value->nama }}</td>
                        <td>{{ $value->jenis_kelamin }}</td>
                        <td>{{ $value->pekerjaan }}</td>
                        <td>
                            <img src="{{ asset('foto/' . $value->foto) }}" alt="" width="50%">
                        </td>
                        <td>
                            <a href="{{ url('/siswa/' . $value->id . '/edit') }}" class="btn btn-warning my-3">Edit</a>
                            <a href="{{ url('/siswa/' . $value->id . '/hapus') }}" class="btn btn-danger my-3">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-5">
        {{ $data->links() }}
    </div>
@endsection
