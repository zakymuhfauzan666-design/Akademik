@extends('layouts.app')

@section('title', 'Ubah ' . $mahasiswa->nama)

@section('content')
    <h1>Ubah Mahasiswa</h1>

    @if ($errors->any())
        <x-alert tipe="bahaya">Ada {{ $errors->count() }} isian yang perlu diperbaiki.</x-alert>
    @endif

    <form class="formulir" method="POST" action="/mahasiswa/{{ $mahasiswa->nim }}">
        @csrf
        @method('PUT')

        @include('mahasiswa._form')

        <button type="submit">Simpan perubahan</button>
        <a href="/mahasiswa/{{ $mahasiswa->nim }}">Batal</a>
    </form>
@endsection