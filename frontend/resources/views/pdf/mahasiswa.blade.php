<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Prodi</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

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

<body>
    <div>
        <div>
            <h3 class="card-title mb-0">Data Mahasiswa</h3>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>NPM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Alamat Mahasiswa</th>
                        <th>Nama Program Studi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($mahasiswaData as $mahasiswa)
                        <tr>
                            <td>{{ $mahasiswa['NPM'] }}</td>
                            <td>{{ $mahasiswa['nama_mahasiswa'] }}</td>
                            <td>{{ $mahasiswa['alamat_mahasiswa'] }}</td>
                            <td>{{ $mahasiswa['id_prodi'] }}</td>
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
