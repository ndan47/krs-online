<div class="row justify-content-center">
    <div class="col-md-10 d-flex justify-content-center">
        <div class="card p-4"
            style="border-radius: 15px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); background: rgb(254, 254, 254, 0.5); backdrop-filter: blur(10px); padding: 30px; width: 100%; max-width: 600px;">
            <h3 class="text-center fw-bold mb-4" style="font-weight:600">Edit Mahasiswa</h3>

            <form action="{{ route('mahasiswa.update', $data['NPM']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group bg-transparent">
                    <label for="NPM" class="form-label fw-semibold mb-1" style=" font-size: 16px;">NPM</label>
                    <input type="text" class="form-control mb-3" id="NPM" name="NPM"
                        placeholder="Masukkan NPM Anda" value="{{ $data['NPM'] }}" required
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent;"
                        readonly>

                    <label for="nama_mahasiswa" class="form-label fw-semibold mb-1" style=" font-size: 16px;">Nama
                        Mahasiswa</label>
                    <input type="text" class="form-control mb-3" id="nama_mahasiswa" name="nama_mahasiswa"
                        placeholder="Masukkan Nama Anda" value="{{ $data['nama_mahasiswa'] }}" required
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent;">

                    <label for="alamat_mahasiswa" class="form-label fw-semibold mb-1" style=" font-size: 16px;">Alamat
                        Mahasiswa</label>
                    <input type="text" class="form-control mb-3" id="alamat_mahasiswa" name="alamat_mahasiswa"
                        placeholder="Masukkan Alamat Rumah Anda" value="{{ $data['alamat_mahasiswa'] }}" required
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent;">

                    <label for="id_prodi" class="form-label fw-semibold mb-1" style="font-size: 16px;">Pilih
                        Program
                        Studi</label>
                    <select class="form-control mb-3" id="id_prodi" name="id_prodi" required
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent; height:50px">
                        @foreach ($datas['data_prodi'] as $prodi)
                            <option
                                value="{{ $prodi['id_prodi'] }}"
                                {{ $prodi['id_prodi'] == $data['id_prodi'] ? 'selected' : '' }}>
                                {{ $prodi['nama_prodi'] }}
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
