@extends('layouts.app')

@section('title', $mahasiswa->nama)

@section('content')

    <h1>{{ $mahasiswa->nama }}</h1>
    <p><a href="/mahasiswa/{{ $mahasiswa->nim }}/ubah">Ubah data</a> &middot; <a href="/mahasiswa">Kembali ke daftar</a></p>
    
    <dl>
        <dt>NIM</dt>
        <dd>{{ $mahasiswa->nim }}</dd>
        <dt>Angkatan</dt>
        <dd>{{ $mahasiswa->angkatan }}</dd>
        <dt>Status</dt>
        <dd>{{ $mahasiswa->status }}</dd>
        <dt>Program Studi</dt>
        <dd>{{ $mahasiswa->prodi->nama }} ({{ $mahasiswa->prodi->jenjang }})</dd>
        <dt>Dosen Wali</dt>
        <dd>{{ $mahasiswa->dosenWali?->nama ?? 'Belum ditentukan' }}</dd>
        <dt>IPK</dt>
        <dd>{{ $mahasiswa->ipk ?? '-' }}</dd>
    </dl>

    <h2>Transkrip</h2>
    <table>
        <thead>
            <tr><th>Kode</th><th>Mata Kuliah</th><th>SKS</th><th>Semester</th><th>Nilai</th><th>Huruf</th><th>Dosen</th></tr>
        </thead>
        <tbody>
            @forelse ($mahasiswa->mataKuliah as $mk)
                <tr>
                    <td><a href="/matkul/{{ $mk->kode }}">{{ $mk->kode }}</a></td>
                    <td>{{ $mk->nama }}</td>
                    <td>{{ $mk->sks }}</td>
                    <td>{{ $mk->pivot->semester }}</td>
                    <td>{{ $mk->pivot->nilai ?? '-' }}</td>
                    <td><x-badge :warna="$mk->pivot->bobot >= 3 ? 'hijau' : 'biru'">{{ $mk->pivot->huruf }}</x-badge></td>
                    <td>{{ $mk->dosen->nama }}</td>
                </tr>
            @empty
                <tr><td colspan="7">Belum mengambil mata kuliah.</td></tr>
            @endforelse
        </tbody>
        @if ($mahasiswa->mataKuliah->isNotEmpty())
            <tfoot>
                <tr><th colspan="2">Total SKS</th><th>{{ $mahasiswa->mataKuliah->sum('sks') }}</th><th colspan="4"></th></tr>
            </tfoot>
        @endif
    </table>

        <h2>UKM yang Diikuti</h2>

    @if ($mahasiswa->ukm->isEmpty())
        <p>Mahasiswa ini belum mengikuti UKM.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama UKM</th>
                    <th>Kategori</th>
                    <th>Jabatan</th>
                    <th>Tanggal Bergabung</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswa->ukm as $u)
                    <tr>
                        <td><a href="/ukm/{{ $u->kode }}">{{ $u->kode }}</a></td>
                        <td>{{ $u->nama }}</td>
                        <td>{{ $u->kategori }}</td>
                        <td>
                            <x-badge :warna="$u->pivot->jabatan === 'ketua' ? 'hijau' : 'abu'">
                                {{ ucfirst($u->pivot->jabatan) }}
                            </x-badge>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($u->pivot->bergabung_pada)->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <p><a href="/mahasiswa">&larr; Kembali ke daftar</a></p>
@endsection
