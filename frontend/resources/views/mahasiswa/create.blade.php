<div class="row justify-content-center">
    <div class="col-md-10 d-flex justify-content-center">
        <div class="card p-4"
            style="border-radius: 15px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); background: rgb(254, 254, 254, 0.5); backdrop-filter: blur(10px); padding: 30px; width: 100%; max-width: 600px;">
            <h3 class="text-center fw-bold mb-4" style="font-weight:600">Tambah Daftar Mahasiswa</h3>
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert"
                    style="background: rgba(220, 53, 69, 0.2); border: 1px solid rgba(220, 53, 69, 0.5); color: #721c24;">
                    {{ session('error') }}
                </div>
            @endif

            <form action="" method="POST">
                @csrf
                <div class="form-group bg-transparent">
                    <label for="NPM" class="form-label fw-semibold mb-1" style=" font-size: 16px;">NPM</label>
                    <input type="text" class="form-control mb-3" id="NPM" name="NPM"
                        placeholder="Masukkan NPM Anda" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        required
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent;">

                    <label for="nama_mahasiswa" class="form-label fw-semibold mb-1" style=" font-size: 16px;">Nama
                        Mahasiswa</label>
                    <input type="text" class="form-control mb-3" id="nama_mahasiswa" name="nama_mahasiswa"
                        placeholder="Masukkan Nama Anda" required
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent;">

                    <label for="alamat_mahasiswa" class="form-label fw-semibold mb-1" style=" font-size: 16px;">Alamat
                        Mahasiswa</label>
                    <input type="text" class="form-control mb-3" id="alamat_mahasiswa" name="alamat_mahasiswa"
                        placeholder="Masukkan Alamat Rumah Anda" required
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent;">

                    <label for="nama_prodi" class="form-label fw-semibold mb-1" style="font-size: 16px;">Pilih
                        Program
                        Studi
                    </label>
                    <select class="form-control mb-3" id="id_prodi" name="id_prodi" required
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent; height:50px">
                        <option value="" disabled selected>Pilih Program Studi</option>
                        @foreach ($datas['data_prodi'] as $data)
                            <option value="{{ $data['id_prodi'] }}">{{ $data['nama_prodi'] }}</option>
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
</div>

<script>
    setTimeout(function() {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500);
        });
    }, 2000);
</script>
