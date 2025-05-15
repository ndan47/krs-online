@extends('main')
@section('title', 'Mahasiswa')

@section('header')
    <div class="row mb-3">
        <div class="col-sm-6">
            <h1 class="fw-bold" style="color: #333;">Mahasiswa</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header d-flex justify-content-between align-items-center bg-white border-bottom">
                        <h5 class="m-0">Daftar Mahasiswa</h5>
                        <div class="input-group" style="width: 300px;">
                            <input type="text" id="searchInput" class="form-control form-control-sm"
                                placeholder="Cari program studi..." style="border-radius: 5px;">
                            <button class="btn btn-light btn-sm" type="button" id="searchButton">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body mt-10" style="background: #f8f9fa; padding: 20px;">
                        <button type="button" class="btn btn-outline-primary shadow" data-toggle="modal"
                            data-target="#TambahMahasiswa"><i class="fas fa-plus"></i>
                            Tambah Mahasiswa
                        </button>
                        <a href="{{ url('/export-mahasiswa-pdf') }}"
                            class="btn btn-outline-warning mb-3 float-right mr-3 shadow"><i
                                class="fas fa-download mr-2"></i>PDF</a>
                        <a href="{{ url('/export-mahasiswa') }}"
                            class="btn btn-outline-secondary mb-3 float-right mr-3 shadow"><i
                                class="fas fa-file-download mr-2"></i>Excel</a>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert"
                                style="background: rgba(40, 167, 69, 0.2); border: 1px solid rgba(40, 167, 69, 0.5); color: #155724;">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert"
                                style="background: rgba(220, 53, 69, 0.2); border: 1px solid rgba(220, 53, 69, 0.5); color: #721c24;">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-center bg-white rounded-3 overflow-hidden"
                                id="produkTable">
                                <thead class="bg-light text-dark">
                                    <tr>
                                        <th class="text-nowrap">No</th>
                                        <th class="text-nowrap">NPM</th>
                                        <th class="text-nowrap">Nama Mahasiswa</th>
                                        <th class="text-nowrap">Alamat Mahasiswa</th>
                                        <th class="text-nowrap">Nama Program Studi</th>
                                        <th class="text-nowrap">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($datas['data_mahasiswa'] == null)
                                        <tr>
                                            <td colspan="12" class="text-center fw-semibold text-muted py-4">
                                                Tidak ada data yang tersedia.
                                            </td>
                                        </tr>
                                    @endif
                                    @if (count($datas) > 0)
                                        @foreach ($datas['data_mahasiswa'] as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data['NPM'] }}</td>
                                                <td>{{ $data['nama_mahasiswa'] }}</td>
                                                <td>{{ $data['alamat_mahasiswa'] }}</td>
                                                <td>{{ $data['nama_prodi'] }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-1">
                                                        {{-- button edit --}}
                                                        <button type="button" class="btn btn-outline-success btn-sm shadow"
                                                            data-toggle="modal"
                                                            data-target="#editMahasiswa{{ $data['NPM'] }}"><i
                                                                class="fas fa-edit"></i>
                                                        </button>

                                                        <form action="{{ route('mahasiswa.destroy', $data['NPM']) }}"
                                                            method="POST" class="ml-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            {{-- button delete --}}
                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-sm shadow">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editMahasiswa{{ $data['NPM'] }}" tabindex="-1"
                                                aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Data Mahasiswa</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @include('mahasiswa.edit')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal tambah --}}
    <div class="modal fade" id="TambahMahasiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Form Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('mahasiswa.create')
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            filterTable();
        });

        // Event listener untuk tombol Enter
        document.getElementById('searchInput').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Mencegah submit form jika ada
                filterTable();
            }
        });

        function filterTable() {
            const searchText = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#produkTable tbody tr');

            rows.forEach(row => {
                const namaMahasiswa = row.querySelector('td:nth-child(3)');
                if (namaMahasiswa) {
                    const text = namaMahasiswa.textContent.toLowerCase();
                    row.style.display = text.includes(searchText) ? '' : 'none';
                }
            });
        }
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 500);
            });
        }, 2000);
    </script>
@endsection
