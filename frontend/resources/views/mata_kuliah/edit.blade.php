<div class="row justify-content-center">
    <div class="col-md-10 d-flex justify-content-center">
        <div class="card p-4"
            style="border-radius: 15px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); background: rgb(254, 254, 254, 0.5); backdrop-filter: blur(10px); padding: 30px; width: 100%; max-width: 600px;">
            <h3 class="text-center fw-bold mb-4" style="font-weight:600">Edit Mata Kuliah</h3>

            <form action="{{ route('matkul.update', $data['id_matkul']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group bg-transparent">
                    <label for="semester" class="form-label fw-semibold mb-1" style=" font-size: 16px;">Semester</label>
                    <input type="text" class="form-control mb-3" id="semester" name="semester"
                        placeholder="Masukkan semester" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        value="{{ old('semester', $data['semester'] ?? '') }}" required
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent;">

                    <label for="nama_matkul" class="form-label fw-semibold mb-1" style=" font-size: 16px;">Nama
                        Mata Kuliah</label>
                    <input type="text" class="form-control mb-3" id="nama_matkul" name="nama_matkul"
                        placeholder="Masukkan Nama Mata Kuliah" required
                        value="{{ old('nama_matkul', $data['nama_matkul'] ?? '') }}"
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent;">

                    <label for="banyak_sks" class="form-label fw-semibold mb-1" style="font-size: 16px;">Banyak
                        SKS</label>
                    <input type="text" class="form-control mb-3" id="banyak_sks" name="banyak_sks"
                        placeholder="Masukkan Jumlah SKS" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        required value="{{ old('banyak_sks', $data['banyak_sks'] ?? '') }}"
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent;">

                    <label for="banyak_jam_matkul" class="form-label fw-semibold mb-1" style="font-size: 16px;">Banyak
                        Jam Matkul</label>
                    <input type="text" class="form-control mb-3" id="banyak_jam_matkul" name="banyak_jam_matkul"
                        placeholder="Masukkan Jumlah Jam Mata Kuliah"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" required
                        value="{{ old('banyak_jam_matkul', $data['banyak_jam_matkul'] ?? '') }}"
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent;">

                    <label for="keterangan" class="form-label fw-semibold mb-1"
                        style="font-size: 16px;">Keterangan</label>
                    <input type="text" class="form-control mb-3" id="keterangan" name="keterangan"
                        placeholder="Masukan Keterangan" value="{{ old('keterangan', $data['keterangan'] ?? '') }}"
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent;">
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button type="button" class="btn btn-outline-secondary shadow" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn shadow"
                        style="border: 2px solid #28a745; color: #28a745; background-color: transparent;"
                        onmouseover="this.style.backgroundColor='#218838'; this.style.color='white';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#218838';">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
