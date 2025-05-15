@php $user = session('user'); @endphp

@extends('main')
@section('title', 'KRS')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="fw-bold">Kartu Rencana Studi</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mx-auto"> 
                <div class="card shadow border-0 rounded-4">
                    <div class="card-header d-flex justify-content-between align-items-center bg-white border-bottom">
                        <h5 class="m-0">Daftar Kartu Rencana Studi Mahasiswa</h5>
                        <div class="input-group" style="width: 300px;">
                            <input type="text" id="searchInput" class="form-control form-control-sm"
                                placeholder="Cari Data KRS..." style="border-radius: 5px;">
                            <button class="btn btn-light btn-sm" type="button" id="searchButton">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($user['role'] !== 'mahasiswa')
                            <button type="button" class="btn btn-outline-primary shadow" data-toggle="modal"
                                data-target="#TambahKRS"><i class="fas fa-plus"></i>
                                Tambah KRS
                            </button>
                        @endif
                        <a href="{{ url('/export-krs-pdf') }}" class="btn btn-outline-warning mb-3 float-right shadow">
                            <i class="fas fa-download mr-2"></i>
                            PDF</a>
                        <a href="{{ url('export-krs') }}" class="btn btn-outline-secondary mb-3 float-right mr-2 shadow"><i
                                class="fas fa-file-download mr-2"></i> Excel</a>

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
                                        <th class="text-nowrap">Waktu</th>
                                        <th class="text-nowrap">Tahun Akademik</th>
                                        <th class="text-nowrap">NPM</th>
                                        <th class="text-nowrap">Nama Mahasiswa</th>
                                        <th class="text-nowrap">Nama Prodi</th>
                                        <th class="text-nowrap">Semester</th>
                                        <th class="text-nowrap">Mata Kuliah</th>
                                        <th class="text-nowrap">Banyak SKS</th>
                                        <th class="text-nowrap">Banyak Jam Mata Kuliah</th>
                                        <th class="text-nowrap">Keterangan</th>
                                        @if ($user['role'] !== 'mahasiswa')
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($datas['data_pengisian_krs'] == null)
                                        <tr>
                                            <td colspan="12" class="text-center fw-semibold text-muted py-4">
                                                Tidak ada data yang tersedia.
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        @if (count($datas) > 0)
                                            @foreach ($datas['data_pengisian_krs'] as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data['timestamp'] }}</td>
                                        <td>{{ $data['tahun_akademik'] }}</td>
                                        <td>{{ $data['NPM'] }}</td>
                                        <td>{{ $data['nama_mahasiswa'] }}</td>
                                        <td>{{ $data['nama_prodi'] }}</td>
                                        <td>{{ $data['semester'] }}</td>
                                        <td>{{ $data['nama_matkul'] }}</td>
                                        <td>{{ $data['banyak_sks'] }}</td>
                                        <td>{{ $data['banyak_jam_matkul'] }}</td>
                                        <td>{{ $data['keterangan'] }}</td>
                                        <td>
                                            @if ($user['role'] !== 'mahasiswa')
                                                <div class="d-flex justify-content-center gap-1">
                                                    {{-- button edit --}}
                                                    <button type="button" class="btn btn-outline-success btn-sm shadow"
                                                        data-toggle="modal"
                                                        data-target="#editKRS{{ $data['id_pengisian'] }}"><i
                                                            class="fas fa-edit"></i>
                                                    </button>

                                                    <form action="{{ route('krs.destroy', $data['id_pengisian']) }}"
                                                        method="POST" class="ml-2">
                                                        @csrf
                                                        @method('DELETE')
                                                        {{-- button delete --}}
                                                        <button type="submit" class="btn btn-outline-danger btn-sm shadow">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-muted"></span>
                                            @endif
                                        </td>

                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editKRS{{ $data['id_pengisian'] }}" tabindex="-1"
                                        aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit KRS</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('krs.edit')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal tambah --}}
    <div class="modal fade" id="TambahKRS" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Form Kartu Rencana Studi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('krs.create')
                </div>
            </div>
        </div>
    </div>
    <!-- Script untuk Pencarian -->
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
                const namaMataKuliah = row.querySelector('td:nth-child(4)');
                if (namaMataKuliah) {
                    const text = namaMataKuliah.textContent.toLowerCase();
                    row.style.display = text.includes(searchText) ? '' : 'none';
                }
            });
        }
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 500); // Hapus elemen setelah fade out
            });
        }, 2000); // 2 detik
    </script>
@endsection
