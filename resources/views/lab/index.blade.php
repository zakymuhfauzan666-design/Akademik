@extends('layouts.app')

@section('title', 'Daftar Inventaris Lab')

@section('content')
    <h1>Inventaris Lab Komputer</h1>

    <!-- Form Penyaringan / Filter -->
    <form class="cari" method="GET" action="/lab">
        <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Cari nama...">
        
        <select name="kategori">
            <option value="">Semua Kategori</option>
            @foreach ($kategoris as $kat)
                <option value="{{ $kat }}" @selected($kategori == $kat)>{{ $kat }}</option>
            @endforeach
        </select>

        <select name="kondisi">
            <option value="">Semua Kondisi</option>
            <option value="baik" @selected($kondisi == 'baik')>Baik</option>
            <option value="perbaikan" @selected($kondisi == 'perbaikan')>Perbaikan</option>
            <option value="rusak" @selected($kondisi == 'rusak')>Rusak</option>
        </select>

        <button type="submit">Cari</button>
        <a href="/lab">Reset</a>
    </form>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Kondisi</th>
                <th>Harga</th>
                <th>Dibeli</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($alats as $a)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="/lab/{{ $a->kode }}">{{ $a->kode }}</a></td>
                    <td>{{ $a->nama }}</td>
                    <td>{{ $a->kategori }}</td>
                    <td>{{ $a->jumlah }}</td>
                    <td>
                        <x-badge :kondisi="$a->kondisi">
                            {{ ucfirst($a->kondisi) }}
                        </x-badge>
                    </td>
                    <td>Rp {{ number_format($a->harga, 0, ',', '.') }}</td>
                    <td>{{ $a->tanggal_beli->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; color: #666;">Tidak ada alat yang cocok.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection