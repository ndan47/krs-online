<div class="row justify-content-center">
    <div class="col-md-10 d-flex justify-content-center">
        <div class="card p-4"
            style="border-radius: 15px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); background: rgb(254, 254, 254, 0.5); backdrop-filter: blur(10px); padding: 30px; width: 100%; max-width: 600px;">
            <h3 class="text-center fw-bold mb-4">Edit Program Studi</h3>

            <form action="{{ route('prodi.update', $data['id_prodi']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group bg-transparent">
                    <label for="nama_prodi" class="form-label fw-semibold" style=" font-size: 16px;">Nama Program
                        Studi</label>
                    <input type="text" class="form-control" id="nama_prodi" name="nama_prodi"
                        placeholder="Masukkan Nama Program Studi" value="{{ $data['nama_prodi'] }}" required
                        style="border-radius: 8px; padding: 12px; font-size: 16px; border: 1px solid #ddd; background: transparent;">
                </div>

                <div class="d-flex justify-content-between mt-3">
                    {{-- <a href="/prodi" class="btn shadow"
                            style="border: 2px solid #6c757d; color: #6c757d; background-color: transparent;"
                            onmouseover="this.style.backgroundColor='#6c757d'; this.style.color='white';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#6c757d';">
                            Close
                        </a> --}}
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
