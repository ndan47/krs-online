<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Prodi</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('templates/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('templates/dist/css/adminlte.min.css') }}">
</head>
<body class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white text-center">
            <h3 class="card-title mb-0">Data Program Studi</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-primary text-white text-center">
                    <tr>
                        <th class="py-3">ID Prodi</th>
                        <th class="py-3">Nama Prodi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($prodiData as $prodi)
                        <tr>
                            <td class="py-2">{{ $prodi['id_prodi'] }}</td>
                            <td class="py-2">{{ $prodi['nama_prodi'] }}</td>
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
