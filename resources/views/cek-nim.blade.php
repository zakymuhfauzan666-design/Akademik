@extends('layouts.app')

@section('title', 'Cek NIM')

@section('content')
    <h1>Cek NIM</h1>

    @if ($errors->any())
        <x-alert tipe="bahaya">{{ $errors->first() }}</x-alert>
    @endif

    <form class="cari" method="GET" action="/cek-nim">
        <input type="text" name="nim" value="{{ $nim }}" placeholder="Awalan NIM, mis. 2024">
        <select name="urut">
            @foreach (['nim' => 'NIM', 'nama' => 'Nama', 'angkatan' => 'Angkatan'] as $kolom => $label)
                <option value="{{ $kolom }}" @selected($urut === $kolom)>Urut: {{ $label }}</option>
            @endforeach
        </select>
        <button type="submit">Cek</button>
    </form>

    @if ($nim !== '')
        <p>{{ count($hasil) }} hasil untuk awalan NIM "{{ $nim }}".</p>

        <table>
            <thead>
                <tr><th>NIM</th><th>Nama</th><th>Status</th></tr>
            </thead>
            <tbody>
                @forelse ($hasil as $baris)
                    <tr>
                        <td>{{ $baris->nim }}</td>
                        <td>{{ $baris->nama }}</td>
                        <td>{{ $baris->status }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3">Tidak ada NIM yang cocok.</td></tr>
                @endforelse
            </tbody>
        </table>
    @endif
@endsection