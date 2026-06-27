<!DOCTYPE html>

<html>
<head>
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2 class="mb-4">Edit Data</h2>

<form action="/update/{{ $item->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- DATA UMUM -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" value="{{ $item->tanggal }}" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" value="{{ $item->nama }}" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Petugas</label>
            <input type="text" name="petugas" value="{{ $item->petugas }}" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Ruangan</label>
            <input type="text" name="ruangan" value="{{ $item->ruangan }}" class="form-control">
        </div>
    </div>

    <hr>

    <!-- MAKANAN UTAMA -->
    <h5 class="mb-3">Makanan Utama (%)</h5>
    <div class="row">
        @foreach(['nasi','hewani','nabati','sayur','buah'] as $itemField)
        <div class="col-md-4 mb-3">
            <label class="form-label">{{ ucfirst($itemField) }}</label>
            <input type="number" name="{{ $itemField }}" value="{{ $item->$itemField }}" class="form-control" min="0" max="100">
        </div>
        @endforeach
    </div>

    <hr>

    <!-- SNACK -->
    <h5 class="mb-3">Snack (%)</h5>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Snack Pagi</label>
            <input type="number" name="snack_pagi" value="{{ $item->snack_pagi }}" class="form-control" min="0" max="100">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Snack Sore</label>
            <input type="number" name="snack_sore" value="{{ $item->snack_sore }}" class="form-control" min="0" max="100">
        </div>
    </div>

    <hr>

    <!-- FOTO -->
    <div class="mb-3">
        <label class="form-label">Foto Lama</label><br>
        @if($item->foto)
            <img src="{{ asset($item->foto) }}" width="120" class="img-thumbnail mb-2">
        @else
            <p class="text-muted">Tidak ada foto</p>
        @endif
    </div>

    <div class="mb-3">
        <label class="form-label">Ganti Foto</label>
        <input type="file" name="foto" class="form-control">
    </div>

    <button class="btn btn-success">Update</button>
    <a href="/tabel" class="btn btn-secondary">Kembali</a>

</form>

</div>

</body>
</html>
