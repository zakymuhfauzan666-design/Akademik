@extends('layouts.app')

@section('title', 'Daftar UKM')

@section('content')
    <h1>Daftar Unit Kegiatan Mahasiswa (UKM)</h1>

    <form method="GET" action="/ukm" style="margin-bottom: 16px;">
        <select name="kategori">
            <option value="">-- Semua Kategori --</option>
            @foreach ($daftarKategori as $kat)
                <option value="{{ $kat }}" @selected($kategori === $kat)>{{ $kat }}</option>
            @endforeach
        </select>
        <button type="submit">Filter</button>
        @if ($kategori)
            <a href="/ukm">Reset</a>
        @endif
    </form>

    @if ($ukms->isEmpty())
        <p>Tidak ada UKM pada kategori ini.</p>
    @else
        @if ($ukms->total() > 0)
            <p>Menampilkan {{ $ukms->firstItem() }}&ndash;{{ $ukms->lastItem() }} dari {{ $ukms->total() }} UKM.</p>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama UKM</th>
                    <th>Kategori</th>
                    <th>Jumlah Anggota</th>
                    <th>Ketua</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ukms as $u)
                    <tr>
                        <td><a href="/ukm/{{ $u->kode }}">{{ $u->kode }}</a></td>
                        <td>{{ $u->nama }}</td>
                        <td>{{ $u->kategori }}</td>
                        <td>{{ $u->anggota_count }}</td>
                        <td>{{ $u->anggota->first()?->nama ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 16px;">
            {{ $ukms->links() }}
        </div>
    @endif
@endsection