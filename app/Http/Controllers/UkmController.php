<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use Illuminate\Http\Request;

class UkmController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->query('kategori');

        $ukms = Ukm::withCount('anggota')
            ->with(['anggota' => fn ($q) => $q->wherePivot('jabatan', 'ketua')])
            ->kategori($kategori)
            ->orderBy('kode')
            ->paginate(5)
            ->withQueryString();

        $daftarKategori = ['Akademik', 'Olahraga', 'Seni', 'Sosial'];

        return view('ukm.index', compact('ukms', 'daftarKategori', 'kategori'));
    }

    public function show(Ukm $ukm)
    {
        $ukm->load([
            'anggota' => fn ($q) => $q->with('prodi')->orderByPivot('bergabung_pada'),
        ]);

        return view('ukm.show', compact('ukm'));
    }
}