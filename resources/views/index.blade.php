@extends('layout')
@section('title', 'home')
@section('content')
    <h1 class="text-center mb-4">
        Selamat Datang di Website Pendaftaran Kursus Elmuna
    </h1>
    <div class="col-4 col-md-4"></div>
    <div class="col-4 col-md-4">
        <div class="card shadow">
            <img src="{{ asset('asset/img/coding.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
                <div class="card-body">
                    <div class="card-text text-center">
                        <h4>Kursus Pemrograman</h4>
                        <a href="{{ url('/pendaftaran') }}" class="btn btn-primary">Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4 col-md-4"></div>

@endsection
