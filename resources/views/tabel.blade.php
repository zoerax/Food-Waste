@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h3 class="mb-3">Data Sisa Makanan</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>Aksi</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Petugas</th>
                    <th>Nasi</th>
                    <th>Hewani</th>
                    <th>Nabati</th>
                    <th>Sayur</th>
                    <th>Buah</th>
                    <th>Snack Pagi</th>
                    <th>Snack Sore</th>
                    <th>Foto</th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $d)
                <tr>
                    <td>
                        <!-- EDIT -->
                        <a href="/edit/{{ $d->id }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <!-- DELETE -->
                        <form action="/delete/{{ $d->id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>

                    <td>{{ $d->tanggal }}</td>
                    <td>{{ $d->nama }}</td>
                    <td>{{ $d->petugas }}</td>
                    <td>{{ $d->nasi }}</td>
                    <td>{{ $d->hewani }}</td>
                    <td>{{ $d->nabati }}</td>
                    <td>{{ $d->sayur }}</td>
                    <td>{{ $d->buah }}</td>
                    <td>{{ $d->snack_pagi }}%</td>
                    <td>{{ $d->snack_sore }}%</td>

                    <td>
                        @if($d->foto)
                            <img src="{{ asset($d->foto) }}" width="60" class="img-thumbnail">
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection