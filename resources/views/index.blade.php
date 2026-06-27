@extends('layouts.app')

@section('content')

<h3>Dashboard Grafik</h3>

<div class="card mb-3">
    <div class="card-body">

        <form action="{{ route('export') }}" method="GET" class="row g-2 align-items-end">

            <div class="col-md-4">
                <label>Tanggal Awal</label>
                <input type="date" name="tanggal_awal" class="form-control form-control-sm" required>
            </div>

            <div class="col-md-4">
                <label>Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" class="form-control form-control-sm" required>
            </div>

            <div class="col-md-4 d-grid">
                <button type="submit" class="btn btn-success btn-sm">
                    Export Excel
                </button>
            </div>

        </form>

    </div>
</div>

<div style="height: 400px;">
    <canvas id="chart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('chart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($bulan),
        datasets: [
            {
                label: 'Nasi',
                data: @json($avgNasi),
            },
            {
                label: 'Hewani',
                data: @json($avgHewani),
            },
            {
                label: 'Nabati',
                data: @json($avgNabati),
            },
            {
                label: 'Sayur',
                data: @json($avgSayur),
            },
            {
                label: 'Buah',
                data: @json($avgBuah),
            },
            {
                label: 'Snack Pagi',
                data: @json($avgSnackPagi ?? []),
            },
            {
                label: 'Snack Sore',
                data: @json($avgSnackSore ?? []),
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top'
            }
        }
    }
});
</script>

@endsection