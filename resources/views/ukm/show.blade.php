@extends('layouts.app')

@section('title', $ukm->nama)

@section('content')
    <p><a href="/ukm">&larr; Kembali ke Daftar UKM</a></p>

    <h1>{{ $ukm->nama }} ({{ $ukm->kode }})</h1>
    <p>
        <strong>Kategori:</strong> {{ $ukm->kategori }} &bull;
        <strong>Tahun Berdiri:</strong> {{ $ukm->tahun_berdiri }} &bull;
        <strong>Jumlah Anggota:</strong> {{ $ukm->anggota->count() }}
    </p>

    <h2>Daftar Anggota</h2>

    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Jabatan</th>
                <th>Tanggal Bergabung</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ukm->anggota as $m)
                <tr>
                    <td><a href="/mahasiswa/{{ $m->nim }}">{{ $m->nim }}</a></td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->prodi->nama }}</td>
                    <td>
                        <x-badge :warna="$m->pivot->jabatan === 'ketua' ? 'hijau' : 'abu'">
                            {{ ucfirst($m->pivot->jabatan) }}
                        </x-badge>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($m->pivot->bergabung_pada)->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada anggota terdaftar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection