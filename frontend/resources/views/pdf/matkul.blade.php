<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Prodi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>

<body class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white text-center">
            <h3 class="card-title mb-0">Data Mata Kuliah</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-success text-white text-center">
                    <tr>
                        <th class="py-3">ID Mata Kuliah</th>
                        <th class="py-3">Semester</th>
                        <th class="py-3">Nama Mata Kuliah</th>
                        <th class="py-3">Banyak SKS</th>
                        <th class="py-3">Banyak JAM Matkul</th>
                        <th class="py-3">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($matkulData as $matkul)
                        <tr>
                            <td class="py-3">{{ $matkul['id_matkul'] }}</td>
                            <td class="py-3">{{ $matkul['semester'] }}</td>
                            <td class="py-3">{{ $matkul['nama_matkul'] }}</td>
                            <td class="py-3">{{ $matkul['banyak_sks'] }}</td>
                            <td class="py-3">{{ $matkul['banyak_jam_matkul'] }}</td>
                            <td class="py-3">{{ $matkul['keterangan'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="{{ asset('/templates/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/templates/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/templates/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
