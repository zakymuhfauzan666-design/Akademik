<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;

class LabController extends Controller
{
public function index(Request $request)
{
    $q        = $request->query('q');
    $kategori = $request->query('kategori');
    $kondisi  = $request->query('kondisi');

    $query = Alat::query();

    if ($q) {
        $query->where('nama', 'like', "%{$q}%");
    }
    if ($kategori) {
        $query->where('kategori', $kategori);
    }
    if ($kondisi) {
        $query->where('kondisi', $kondisi);
    }

    $alats = $query->orderBy('kode')->get();
    $total = Alat::count();

    // Ringkasan (Item 3)
    $ringkasan = [
        'Jenis alat'      => $alats->count(),
        'Total unit'      => $alats->sum('jumlah'),
        'Nilai aset'      => $alats->sum(fn($a) => $a->jumlah * $a->harga),
        'Rata-rata harga' => $alats->avg('harga'),
    ];

    $termahal  = $alats->sortByDesc('harga')->first();

    $perKondisi = [
        'baik'      => $alats->where('kondisi', 'baik')->sum('jumlah'),
        'perbaikan' => $alats->where('kondisi', 'perbaikan')->sum('jumlah'),
        'rusak'     => $alats->where('kondisi', 'rusak')->sum('jumlah'),
    ];

    $kategoris = Alat::select('kategori')->distinct()->pluck('kategori');

    return view('lab.index', compact(
        'alats', 'total', 'ringkasan', 'termahal', 'perKondisi', 'kategoris', 'q', 'kategori', 'kondisi'
    ));
}

    public function show(Alat $alat)
    {
        return view('lab.show', compact('alat'));
    }
}