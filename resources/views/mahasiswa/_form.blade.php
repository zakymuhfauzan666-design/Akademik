<div>
    <label for="nim">NIM</label>
    <input type="text" id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" @class(['salah' => $errors->has('nim')])>
    @error('nim') <small class="galat">{{ $message }}</small> @enderror
</div>

<div>
    <label for="nama">Nama lengkap</label>
    <input type="text" id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" @class(['salah' => $errors->has('nama')])>
    @error('nama') <small class="galat">{{ $message }}</small> @enderror
</div>

<div>
    <label for="angkatan">Angkatan</label>
    <input type="text" id="angkatan" name="angkatan" value="{{ old('angkatan', $mahasiswa->angkatan) }}" @class(['salah' => $errors->has('angkatan')])>
    @error('angkatan') <small class="galat">{{ $message }}</small> @enderror
</div>

<div>
    <label for="prodi_id">Program studi</label>
    <select id="prodi_id" name="prodi_id" @class(['salah' => $errors->has('prodi_id')])>
        <option value="">-- pilih --</option>
        @foreach ($prodis as $p)
            <option value="{{ $p->id }}" @selected(old('prodi_id', $mahasiswa->prodi_id) == $p->id)>{{ $p->nama }}</option>
        @endforeach
    </select>
    @error('prodi_id') <small class="galat">{{ $message }}</small> @enderror
</div>

<div>
    <label for="dosen_wali_id">Dosen wali (boleh kosong)</label>
    <select id="dosen_wali_id" name="dosen_wali_id" @class(['salah' => $errors->has('dosen_wali_id')])>
        <option value="">-- belum ditentukan --</option>
        @foreach ($dosens as $d)
            <option value="{{ $d->id }}" @selected(old('dosen_wali_id', $mahasiswa->dosen_wali_id) == $d->id)>{{ $d->nama }}</option>
        @endforeach
    </select>
    @error('dosen_wali_id') <small class="galat">{{ $message }}</small> @enderror
</div>