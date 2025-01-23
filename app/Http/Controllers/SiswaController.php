<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller

{

    function pendaftaran()
    {
        return view('siswa.pendaftaran');
    }

    function store(Request $request)
    {
        $request->validate([
            'nik' => 'required | min:16',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'pekerjaan' => 'required',
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:1040'
        ], [
            'nik.required' => 'nik harus diisi',
            'nik.min' => 'nik harus 16 digit',
            'nama.required' => 'nama harus diisi',
            'jenis_kelamin.required' => 'jenis kelamin harus diisi',
            'pekerjaan.required' => 'pekerjaan harus diisi',
            'foto.required' => 'foto harus diisi',
            'foto.image' => 'foto harus berupa gambar',
            'foto.mimes' => 'foto harus berupa png,jpg,jpeg',
            'foto.max' => 'foto tidak boleh lebih dari 1mb'


        ]);



        if ($request->hasFile('foto')) {
            $gambar = $request->file('foto');
            $namaGambar = time() . '.' . $gambar->getClientOriginalName();
            $lokasi = public_path('foto');
            $gambar->move($lokasi, $namaGambar);
        }
        $data = [
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pekerjaan' => $request->pekerjaan,
            'foto' => $namaGambar
        ];

        Siswa::create($data);
        sweetalert()->success('Anda,' . $request->nama . 'telah berhasil mendaftar!');
        return redirect('/pendaftaran');
    }

    function index(Request $request)
    {
        $cari = $request->cari;
        $data = Siswa::where(function ($query) use ($cari) {
            $query->where('nik', 'like', '%' . $cari . '%')
                ->orWhere('nama', 'like', '%' . $cari . '%')
                ->orWhere('nisn', 'like', '%' . $cari . '%')
                ->orWhere('pekerjaan', 'like', '%' . $cari . '%');
        })->orderBy('id', 'desc')
            ->paginate(2)
            ->withQueryString();

        return view('siswa.index', ['data' => $data]);
    }
}
