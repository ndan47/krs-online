<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Data KRS</title>
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
    <h2>Data Pengisian KRS</h2>
    <table>
        <thead>
            <tr>
                <th>Waktu</th>
                <th>Tahun Akademik</th>
                <th>NPM</th>
                <th>Nama Mahasiswa</th>
                <th>Nama Prodi</th>
                <th>Semester</th>
                <th>Nama Matkul</th>
                <th>SKS</th>
                <th>Jam</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($krsData as $item)
                <tr>
                    <td>{{ $item['timestamp'] }}</td>
                    <td>{{ $item['tahun_akademik'] }}</td>
                    <td>{{ $item['NPM'] }}</td>
                    <td>{{ $item['nama_mahasiswa'] }}</td>
                    <td>{{ $item['nama_prodi'] }}</td>
                    <td>{{ $item['semester'] }}</td>
                    <td>{{ $item['nama_matkul'] }}</td>
                    <td>{{ $item['banyak_sks'] }}</td>
                    <td>{{ $item['banyak_jam_matkul'] }}</td>
                    <td>{{ $item['keterangan'] ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
