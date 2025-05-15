<div class="row justify-content-center">
    <div class="col-md-10 d-flex justify-content-center">
        <div class="card p-4"
            style="border-radius: 15px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); background: rgb(254, 254, 254, 0.5); backdrop-filter: blur(10px); padding: 30px; width: 100%; max-width: 600px;">
            <h3 class="text-center fw-bold mb-4" style="font-weight:600">Tambah Data KRS</h3>
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert"
                    style="background: rgba(220, 53, 69, 0.2); border: 1px solid rgba(220, 53, 69, 0.5); color: #721c24;">
                    {{ session('error') }}
                </div>
            @endif

            <form action="" method="POST">
                @csrf
                <div class="form-group bg-transparent">
                    <label for="timestamp" class="form-label fw-semibold mb-1" style=" font-size: 16px;">Waktu</label>
                    <input type="datetime-local" autocomplete="off" class="form-control mb-3" id="timestamp" name="timestamp" required
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent;">

                    <label for="tahun_akademik" class="form-label fw-semibold mb-1" style=" font-size: 16px;">Tahun
                        Akademik</label>
                    <select name="tahun_akademik" class="form-control mb-3" id="tahun_akademik" name="tahun_akademik"
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent; height:50px"
                        required>
                        <option value="" disabled selected>Pilih Tahun Akademik</option>
                        <option value="2021/2022">2021/2022</option>
                        <option value="2022/2023">2022/2023</option>
                        <option value="2023/2024">2023/2024</option>
                        <option value="2024/2025">2024/2025</option>
                        <option value="2025/2026">2025/2026</option>
                    </select>

                    <label for="NPM" class="form-label fw-semibold mb-1" style=" font-size: 16px;">NPM</label>
                    <input type="text" class="form-control mb-3" id="NPM" name="NPM"
                        placeholder="Masukkan NPM Anda" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        required
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent;">
                        
                        <label for="id_matkul" class="form-label fw-semibold mb-1" style="font-size: 16px;">
                        Mata Kuliah
                    </label>
                        <select class="form-control mb-3" id="id_matkul" name="id_matkul" required
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent; height:50px">
                        <option value="" disabled selected>Pilih Mata Kuliah</option>
                        @foreach ($dataMatkul['data_matkul'] as $data)
                            <option value="{{ $data['id_matkul'] }}">{{ $data['nama_matkul'] }}</option>
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
    // add event listener buat ilangin timestamp
    document.addEventListener('DOMContenLoaded', function(){
        const datetimeInput = document.getElementById('timestamp');
        datetimeInput.addEventListener('change', function (){
          this.blur();
        });
    });

    setTimeout(function() {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500);
        });
    }, 2000);
</script>
