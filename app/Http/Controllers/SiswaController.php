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
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:10240'
        ], [
            'nik.required' => 'nik harus diisi',
            'nik.min' => 'nik harus minimal :min digit',
            'nama.required' => 'nama harus diisi',
            'jenis_kelamin.required' => 'jenis kelamin harus diisi',
            'pekerjaan.required' => 'pekerjaan harus diisi',
            'foto.required' => 'foto harus diisi',
            'foto.image' => 'foto harus berupa gambar',
            'foto.mimes' => 'foto harus berupa png,jpg,jpeg',
            'foto.max' => 'foto tidak boleh lebih dari :max mb'


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

    function edit(Request $request, $id)
    {
        $data = Siswa::findOrFail($id);

        return view('siswa.edit', ['data' => $data]);
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required | min:16',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'pekerjaan' => 'required',
            'foto' => 'image|mimes:png,jpg,jpeg|max:10240'
        ], [
            'nik.required' => 'nik harus diisi',
            'nik.min' => 'nik harus minimal :min digit',
            'nama.required' => 'nama harus diisi',
            'jenis_kelamin.required' => 'jenis kelamin harus diisi',
            'pekerjaan.required' => 'pekerjaan harus diisi',
            'foto.image' => 'foto harus berupa gambar',
            'foto.mimes' => 'foto harus berupa png,jpg,jpeg',
            'foto.max' => 'foto tidak boleh lebih dari :max mb'

        ]);

        $siswa = Siswa::findOrFail($id);

        if ($request->hasFile('foto')) {
            if (isset($siswa->foto) && file_exists(public_path('foto') . '/' . $siswa->foto)) {
                unlink(public_path('foto') . '/' . $siswa->foto);
            }

            $gambar = $request->file('foto');
            $namaGambar = time() . '.' . $gambar->getClientOriginalName();
            $lokasi = public_path('foto');
            $gambar->move($lokasi, $namaGambar);
        }
        $data = [
            'nik' => $request->nik,
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pekerjaan' => $request->pekerjaan,
            'foto' => isset($namaGambar) ? $namaGambar : $siswa->foto,
        ];

        $siswa->update($data);
        sweetalert()->success('data siswa berhasil diubah');
        return redirect('/siswa');
    }

    function delete($id)
    {
        $data = Siswa::findOrFail($id);

        return view('siswa.hapus', ['data' => $data]);
    }

    function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        if (isset($siswa->foto) && file_exists(public_path('foto') . '/' . $siswa->foto)) {
            unlink(public_path('foto') . '/' . $siswa->foto);
        }

        $siswa->delete();
        sweetalert()->success('data siswa berhasil dihapus');
        return redirect('/siswa');
    }
}
