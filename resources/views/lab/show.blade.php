@extends('layouts.app')

@section('title', $alat->nama)

@section('content')
    <h1>{{ $alat->nama }}</h1>

    <dl>
        <dt>Kode</dt>
        <dd>{{ $alat->kode }}</dd>
        <dt>Kategori</dt>
        <dd>{{ $alat->kategori }}</dd>
        <dt>Jumlah</dt>
        <dd>{{ $alat->jumlah }} Unit</dd>
        <dt>Kondisi</dt>
        <dd>{{ ucfirst($alat->kondisi) }}</dd>
        <dt>Harga Satuan</dt>
        <dd>Rp {{ number_format($alat->harga, 0, ',', '.') }}</dd>
        <dt>Tanggal Beli</dt>
        <dd>{{ $alat->tanggal_beli->format('d/m/Y') }}</dd>
    </dl>

    <p><a href="/lab">&larr; Kembali ke daftar</a></p>
@endsection