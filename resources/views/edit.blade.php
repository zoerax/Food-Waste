<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Edit Data</h2>

    <form action="/update/{{ $item->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="date" name="tanggal" value="{{ $item->tanggal }}" class="form-control mb-2">

        <input type="text" name="nama" value="{{ $item->nama }}" class="form-control mb-2">

        <input type="text" name="petugas" value="{{ $item->petugas }}" class="form-control mb-2">

        <input type="text" name="ruangan" value="{{ $item->ruangan }}" class="form-control mb-2">

        {{-- Makanan utama --}}
        @foreach(['nasi','hewani','nabati','sayur','buah'] as $itemField)
            <input type="number" name="{{ $itemField }}" value="{{ $item->$itemField }}" class="form-control mb-2" placeholder="{{ ucfirst($itemField) }}">
        @endforeach

        {{-- Snack --}}
        <input type="number" name="snack_pagi" value="{{ $item->snack_pagi }}" class="form-control mb-2" placeholder="Snack Pagi (%)">

        <input type="number" name="snack_sore" value="{{ $item->snack_sore }}" class="form-control mb-2" placeholder="Snack Sore (%)">

        {{-- Foto --}}
        <div class="mb-2">
            <label>Foto Lama</label><br>
            @if($item->foto)
                <img src="{{ asset($item->foto) }}" width="100" class="mb-2">
            @else
                <p>Tidak ada foto</p>
            @endif
        </div>
        
        <div class="mb-2">
            <label>Ganti Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>

</body>
</html>