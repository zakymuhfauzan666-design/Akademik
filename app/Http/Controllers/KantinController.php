<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KantinController extends Controller
{
    private function getDataMenu()
    {
        return [
            [
                'nama' => 'Nasi Goreng Spesial', 
                'kategori' => 'Makanan', 
                'harga' => 18000, 
                'stok' => 12
            ],
            [
                'nama' => 'Mie Ayam Bakso', 
                'kategori' => 'Makanan', 
                'harga' => 15000, 
                'stok' => 0
            ],
            [
                'nama' => 'Es Teh Manis', 
                'kategori' => 'Minuman', 
                'harga' => 5000, 
                'stok' => 40
            ],
            [
                'nama' => 'Kopi Susu Gula Aren', 
                'kategori' => 'Minuman', 
                'harga' => 14000, 
                'stok' => 3
            ],
            [
                'nama' => 'Pisang Goreng Keju', 
                'kategori' => 'Camilan', 
                'harga' => 10000, 
                'stok' => 8
            ],
            [
                'nama' => 'Roti Bakar <b>Coklat</b>', 
                'kategori' => 'Camilan', 
                'harga' => 12000, 
                'stok' => 0
            ],
        ];
    }

    public function index()
    {
        $menu = $this->getDataMenu();
        $totalMenu = count($menu);
        $totalHabis = collect($menu)->where('stok', 0)->count();

        return view('kantin.index', compact('menu', 'totalMenu', 'totalHabis'));
    }

    public function tentang()
    {
        return view('kantin.tentang');
    }

    public function kosong()
    {
        $menu = [];
        $totalMenu = 0;
        $totalHabis = 0;

        return view('kantin.index', compact('menu', 'totalMenu', 'totalHabis'));
    }
}