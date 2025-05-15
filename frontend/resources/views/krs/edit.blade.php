<div class="row justify-content-center">
    <div class="col-md-10 d-flex justify-content-center">
        <div class="card p-4"
            style="border-radius: 15px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); background: rgb(254, 254, 254, 0.5); backdrop-filter: blur(10px); padding: 30px; width: 100%; max-width: 600px;">
            <h3 class="text-center fw-bold mb-4" style="font-weight:600">Edit Kartu Rencana Studi Mahasiswa</h3>

            <form action="{{ route('krs.update', $data['id_pengisian']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group bg-transparent">
                    <label for="timestamp" class="form-label fw-semibold mb-1" style=" font-size: 16px;">Waktu</label>
                    <input type="datetime-local" autocomplete="off" class="form-control mb-3" id="timestamp"
                        name="timestamp" value="{{ $data['timestamp'] }}" required
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent;">

                    <label for="tahun_akademik" class="form-label fw-semibold mb-1" style=" font-size: 16px;">Tahun
                        Akademik</label>
                    <select name="tahun_akademik" class="form-control mb-3" id="tahun_akademik"
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent; height:50px"
                        required>
                        <option value="" disabled {{ !$data['tahun_akademik'] ? 'selected' : '' }}>Pilih Tahun
                            Akademik</option>
                        <option value="2021/2022" {{ $data['tahun_akademik'] == '2021/2022' ? 'selected' : '' }}>
                            2021/2022</option>
                        <option value="2022/2023" {{ $data['tahun_akademik'] == '2022/2023' ? 'selected' : '' }}>
                            2022/2023</option>
                        <option value="2023/2024" {{ $data['tahun_akademik'] == '2023/2024' ? 'selected' : '' }}>
                            2023/2024</option>
                        <option value="2024/2025" {{ $data['tahun_akademik'] == '2024/2025' ? 'selected' : '' }}>
                            2024/2025</option>
                        <option value="2025/2026" {{ $data['tahun_akademik'] == '2025/2026' ? 'selected' : '' }}>
                            2025/2026</option>
                    </select>
                    <label for="NPM" class="form-label fw-semibold mb-1" style=" font-size: 16px;">NPM</label>
                    <input type="text" class="form-control mb-3" id="NPM" name="NPM"
                        placeholder="Masukkan NPM Anda" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        value="{{ $data['NPM'] }}" required
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent;">

                    <label for="id_matkul" class="form-label fw-semibold mb-1" style="font-size: 16px;">
                        Mata Kuliah
                    </label>
                    <select class="form-control mb-3" id="id_matkul" name="id_matkul" required
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent; height:50px">

                        @foreach ($dataMatkul['data_matkul'] as $dataMatkul)
                            <option value="{{ $dataMatkul['id_matkul'] }}"
                                {{ $dataMatkul['id_matkul'] == $data['id_matkul'] ? 'selected' : '' }}>
                                {{ $dataMatkul['nama_matkul'] }}
                            </option>
                        @endforeach
                    </select>
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
