<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use Illuminate\Validation\Rule;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;


class MahasiswaController extends Controller
{
    public function create()
    {
        $prodis = Prodi::orderBy('kode')->get();
        $dosens = Dosen::orderBy('nama')->get();
        $mahasiswa = new Mahasiswa(); // kosong, supaya formulir yang sama dipakai untuk tambah dan ubah

        return view('mahasiswa.create', compact('mahasiswa', 'prodis', 'dosens'));
    }

    public function store(StoreMahasiswaRequest $request)
    {
        //$mahasiswa = Mahasiswa::create($request->all());
        $mahasiswa = Mahasiswa::create($request->validated());

        return redirect('/mahasiswa/' . $mahasiswa->nim)
            ->with('sukses', "Mahasiswa {$mahasiswa->nama} berhasil ditambahkan.");
    }

        public function edit(Mahasiswa $mahasiswa)
    {
        $prodis = Prodi::orderBy('kode')->get();
        $dosens = Dosen::orderBy('nama')->get();

        return view('mahasiswa.edit', compact('mahasiswa', 'prodis', 'dosens'));
    }

    public function update(UpdateMahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        $mahasiswa->update($request->validated());

        return redirect('/mahasiswa/' . $mahasiswa->nim)
            ->with('sukses', "Data {$mahasiswa->nama} berhasil diperbarui.");
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect('/mahasiswa')
            ->with('sukses', "Mahasiswa {$mahasiswa->nama} berhasil dihapus.");
    }

    public function cekNim(Request $request)
    {
        $data = $request->validate([
            'nim'  => ['nullable', 'string', 'max:12'],
            'urut' => ['nullable', Rule::in(['nim', 'nama', 'angkatan'])],
        ], [
            'urut.in' => 'Urutan harus salah satu dari: nim, nama, angkatan.',
            'nim.max' => 'NIM maksimal 12 karakter.',
        ]);

        $nim  = $data['nim'] ?? '';
        $urut = $data['urut'] ?? 'nim';

        $hasil = $nim === '' ? collect() : Mahasiswa::select('nim', 'nama', 'status')
            ->where('nim', 'like', $nim . '%')
            ->orderBy($urut)
            ->get();

        return view('cek-nim', compact('nim', 'urut', 'hasil'));
    }
}