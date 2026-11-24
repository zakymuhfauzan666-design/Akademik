<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Http\Resources\MahasiswaResource;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use Illuminate\Http\Request;


class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::with('prodi')->orderBy('nim')->paginate(10);

        return MahasiswaResource::collection($mahasiswas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMahasiswaRequest $request)
    {
        $mahasiswa = Mahasiswa::create($request->validated())->fresh();

        return (new MahasiswaResource($mahasiswa->load('prodi')))
            ->response()
            ->setStatusCode(201)
            ->header('Location', url('/api/mahasiswa/' . $mahasiswa->nim));
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load(['prodi', 'dosenWali', 'mataKuliah']);

        return new MahasiswaResource($mahasiswa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        $mahasiswa->update($request->validated());

        return new MahasiswaResource($mahasiswa->load('prodi'));
    }

        /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return response()->noContent(); // 204: berhasil, tidak ada isi
    }
}
