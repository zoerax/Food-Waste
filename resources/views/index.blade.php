<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Food Waste</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background-color: #f5f7fa;
        }

        .card {
            border-radius: 15px;
        }

        .card-title {
            font-weight: 600;
        }

        .table img {
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container py-4">

    <!-- HEADER -->
    <div class="mb-4">
        <h3 class="fw-bold">📊 Dashboard Sisa Makanan</h3>
        <p class="text-muted">Monitoring sisa makanan per bulan</p>
    </div>

    <!-- FILTER + EXPORT -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form action="/export" method="GET" class="row g-2 align-items-end">

                <div class="col-md-3">
                    <label>Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <button class="btn btn-success w-100">
                        Export Excel
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- GRAFIK -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">📈 Grafik Rata-rata Sisa Makanan per Bulan</h5>
            <canvas id="chart"></canvas>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="card shadow-sm mb-4">
                <div class="card-body">
            
                    <h5 class="card-title mb-3">Tambah Data Sisa Makanan</h5>
            
                    <form action="/store" method="POST" enctype="multipart/form-data">
                        @csrf
            
                        <div class="row g-2">
            
                            <div class="col-md-3">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
            
                            <div class="col-md-3">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
            
                            <div class="col-md-3">
                                <label>Petugas</label>
                                <input type="text" name="petugas" class="form-control" required>
                            </div>
            
                            <div class="col-md-3">
                                <label>Ruangan</label>
                                <select name="ruangan" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option>Bougenville</option>
                                    <option>Seruni</option>
                                    <option>Cempaka</option>
                                    <option>Melati</option>
                                    <option>Dahlia</option>
                                    <option>Mawar</option>
                                    <option>Anggrek</option>
                                    <option>Flamboyan</option>
                                    <option>Edelweis</option>
                                    <option>Nusa Indah</option>
                                </select>
                            </div>
            
                            <div class="col-md-2">
                                <label>Nasi (%)</label>
                                <input type="number" name="nasi" class="form-control" required>
                            </div>
            
                            <div class="col-md-2">
                                <label>Hewani (%)</label>
                                <input type="number" name="hewani" class="form-control" required>
                            </div>
            
                            <div class="col-md-2">
                                <label>Nabati (%)</label>
                                <input type="number" name="nabati" class="form-control" required>
                            </div>
            
                            <div class="col-md-2">
                                <label>Sayur (%)</label>
                                <input type="number" name="sayur" class="form-control" required>
                            </div>
            
                            <div class="col-md-2">
                                <label>Buah (%)</label>
                                <input type="number" name="buah" class="form-control" required>
                            </div>
            
                            <div class="col-md-2">
                                <label>Foto</label>
                                <input type="file" name="foto" class="form-control" required>
                            </div>
            
                            <div class="col-md-12 mt-3">
                                <button class="btn btn-primary w-100">
                                    Simpan Data
                                </button>
                            </div>
            
                        </div>
                    </form>
            
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>Foto</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Petugas</th>
                            <th>Ruangan</th>
                            <th>Nasi</th>
                            <th>Hewani</th>
                            <th>Nabati</th>
                            <th>Sayur</th>
                            <th>Buah</th>
                            <th>Rata-rata</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/'.$item->foto) }}" width="60">
                            </td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->petugas }}</td>
                            <td>{{ $item->ruangan }}</td>
                            <td>{{ $item->nasi }}%</td>
                            <td>{{ $item->hewani }}%</td>
                            <td>{{ $item->nabati }}%</td>
                            <td>{{ $item->sayur }}%</td>
                            <td>{{ $item->buah }}%</td>
                            <td><span class="badge bg-info">{{ $item->rata_rata }}%</span></td>

                            <td>
                                <a href="/edit/{{ $item->id }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="/delete/{{ $item->id }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<!-- CHART -->
<script>
    const ctx = document.getElementById('chart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($bulan) !!},
            datasets: [
                {
                    label: 'Nasi',
                    data: {!! json_encode($avgNasi) !!}
                },
                {
                    label: 'Hewani',
                    data: {!! json_encode($avgHewani) !!}
                },
                {
                    label: 'Nabati',
                    data: {!! json_encode($avgNabati) !!}
                },
                {
                    label: 'Sayur',
                    data: {!! json_encode($avgSayur) !!}
                },
                {
                    label: 'Buah',
                    data: {!! json_encode($avgBuah) !!}
                }
            ]
        }
    });
</script>

</body>
</html>