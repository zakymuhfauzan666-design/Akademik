@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
    <h1>Tambah Mahasiswa</h1>

    @if ($errors->any())
        <x-alert tipe="bahaya">Ada {{ $errors->count() }} isian yang perlu diperbaiki.</x-alert>
    @endif

    <form class="formulir" method="POST" action="/mahasiswa">
        @csrf

        @include('mahasiswa._form')

        <button type="submit">Simpan</button>
        <a href="/mahasiswa">Batal</a>
    </form>
@endsection