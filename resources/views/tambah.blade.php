@extends('layouts.app')

@section('content')

<div class="container mt-3">

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card shadow">
            <div class="card-body">

                <h5 class="mb-3 text-center">Tambah Data</h5>

                {{-- ERROR VALIDASI --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/store" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <!-- KIRI -->
                        <div class="col-md-6">

                            <div class="mb-2">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control form-control-sm" required>
                            </div>

                            <div class="mb-2">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control form-control-sm" required>
                            </div>

                            <div class="mb-2">
                                <label>Petugas</label>
                                <input type="text" name="petugas" class="form-control form-control-sm" required>
                            </div>

                            <div class="mb-2">
                                <label>Ruangan</label>
                                <select name="ruangan" class="form-control form-control-sm" required>
                                    <option value="">-- Pilih Ruangan --</option>
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

                            <div class="mb-2">
                                <label>Nasi(%)</label>
                                <input type="number" name="nasi" class="form-control form-control-sm" required>
                            </div>

                            <div class="mb-2">
                                <label>Hewani(%)</label>
                                <input type="number" name="hewani" class="form-control form-control-sm" required>
                            </div>

                        </div>

                        <!-- KANAN -->
                        <div class="col-md-6">

                            <div class="mb-2">
                                <label>Nabati(%)</label>
                                <input type="number" name="nabati" class="form-control form-control-sm" required>
                            </div>
                            
                            <div class="mb-2">
                                <label>Sayur(%)</label>
                                <input type="number" name="sayur" class="form-control form-control-sm" required>
                            </div>

                            <div class="mb-2">
                                <label>Buah(%)</label>
                                <input type="number" name="buah" class="form-control form-control-sm">
                            </div>

                            <div class="mb-2">
                                <label>Snack Pagi (%)</label>
                                <input type="number" name="snack_pagi" class="form-control">
                            </div>
                            
                            <div class="mb-2">
                                <label>Snack Sore (%)</label>
                                <input type="number" name="snack_sore" class="form-control">
                            </div>

                            <div class="mb-2">
                                <label>Foto</label>
                                <input type="file" name="foto" class="form-control form-control-sm">
                            </div>

                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3 btn-sm">
                        Simpan
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

</div>
@endsection
