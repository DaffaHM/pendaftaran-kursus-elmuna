@extends('dashboard.dashboard')
@section('title', 'hapus data')
@section('content')
    <h1 class="text-center">hapus data siswa</h1>


    <div class="alert alert-danger" role="alert">
        <h1 class="text-center mb-3"> <i class='bx bx-error'></i> Apakah anda yakin ingin menghapus data siswa
            <br>
            Data yang dihapus tidak dapat dikembalikan!
        </h1>
    </div>
    <table class="table">
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $data->nik }}</td>
        </tr>
        <tr>
            <td>NISN</td>
            <td>:</td>
            <td>{{ $data->nisn }}</td>
        </tr>
        <tr>
            <td>NAMA</td>
            <td>:</td>
            <td>{{ $data->nama }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $data->pekerjaan }}</td>
        </tr>
        <tr>
            <td>pekerjaan</td>
            <td>:</td>
            <td>{{ $data->pekerjaan }}</td>
        </tr>
        <tr>
            <td>foto</td>
            <td>:</td>
            <td>
                <img src="{{ asset('foto/' . $data->foto) }}" alt="" class="img-thumbnail" width="15%">
            </td>
        </tr>

    </table>
    <center>
        <form action="{{ url('/hapus-siswa/' . $data->id) }}" method="post">
            @csrf
            @method('delete')
            <a href="{{ url('/siswa') }}" class="btn btn-secondary">kembali</a>
            <button type="submit" class="btn btn-danger">hapus</button>
        </form>
    </center>
@endsection
