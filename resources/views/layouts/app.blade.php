<!DOCTYPE html>
<html>
<head>
    <title>Food Waste App</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            display: flex;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background: #2c3e50;
            color: white;
            padding: 20px;
        }

        .sidebar a {
            display: block;
            color: #bdc3c7;
            margin: 10px 0;
            text-decoration: none;
        }

        .sidebar a:hover {
            color: white;
        }

        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="sidebar">

        <h4 class="text mb-4">Food Waste</h4>
        <hr style="border-color: rgba(255,255,255,0.2);">
    
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('tambah') }}">Tambah Data</a>
        <a href="{{ route('tabel') }}">Tabel Data</a>
    
    </div>

<div class="content">
    @yield('content')
</div>

</body>
</html>