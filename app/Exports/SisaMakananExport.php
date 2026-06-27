<?php

namespace App\Exports;

use App\Models\SisaMakanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SisaMakananExport implements FromCollection, WithHeadings
{
    protected $tanggal_awal;
    protected $tanggal_akhir;

    public function __construct($tanggal_awal, $tanggal_akhir)
    {
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
    }

    public function collection()
    {
        return SisaMakanan::whereBetween('tanggal', [
                $this->tanggal_awal,
                $this->tanggal_akhir
            ])
            ->select(
                'tanggal',
                'nama',
                'petugas',
                'ruangan',
                'nasi',
                'hewani',
                'nabati',
                'sayur',
                'buah',
                'snack_pagi',
                'snack_sore',
                'rata_rata'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama',
            'Petugas',
            'Ruangan',
            'Nasi (%)',
            'Hewani (%)',
            'Nabati (%)',
            'Sayur (%)',
            'Buah (%)',
            'Snack Pagi (%)',
            'Snack Sore (%)',
            'Rata-rata (%)'
        ];
    }
}