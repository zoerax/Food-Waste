<?php

namespace App\Http\Controllers;

use App\Exports\SisaMakananExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SisaMakanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SisaMakananController extends Controller
{

    public function index()
    {
        $data = SisaMakanan::all();

        // GROUP PER BULAN
        $chart = SisaMakanan::selectRaw("
            MONTH(tanggal) as bulan,
            AVG(nasi) as avgNasi,
            AVG(hewani) as avgHewani,
            AVG(nabati) as avgNabati,
            AVG(sayur) as avgSayur,
            AVG(buah) as avgBuah
        ")
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

        // NAMA BULAN
        $namaBulan = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar',
            4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
            7 => 'Jul', 8 => 'Agu', 9 => 'Sep',
            10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];

        $bulan = [];
        $avgNasi = [];
        $avgHewani = [];
        $avgNabati = [];
        $avgSayur = [];
        $avgBuah = [];

        foreach ($chart as $item) {
            $bulan[] = $namaBulan[$item->bulan];
            $avgNasi[] = round($item->avgNasi, 1);
            $avgHewani[] = round($item->avgHewani, 1);
            $avgNabati[] = round($item->avgNabati, 1);
            $avgSayur[] = round($item->avgSayur, 1);
            $avgBuah[] = round($item->avgBuah, 1);
        }

        return view('index', compact(
            'data',
            'bulan',
            'avgNasi',
            'avgHewani',
            'avgNabati',
            'avgSayur',
            'avgBuah'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama' => 'required|string',
            'petugas' => 'required|string',
            'ruangan' => 'required|string',
            'nasi' => 'required|numeric|max:95',
            'hewani' => 'required|numeric|max:95',
            'nabati' => 'required|numeric|max:95',
            'sayur' => 'required|numeric|max:95',
            'buah' => 'required|numeric|max:95',
            'foto' => 'nullable|image'
        ]);

        // upload foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto', 'public');
        }

        // hitung rata-rata
        $rata = (
            $request->nasi +
            $request->hewani +
            $request->nabati +
            $request->sayur +
            $request->buah
        ) / 5;

        SisaMakanan::create([
            'tanggal' => $request->tanggal,
            'nama' => $request->nama,
            'petugas' => $request->petugas,
            'ruangan' => $request->ruangan,
            'foto' => $fotoPath,
            'nasi' => $request->nasi,
            'hewani' => $request->hewani,
            'nabati' => $request->nabati,
            'sayur' => $request->sayur,
            'buah' => $request->buah,
            'rata_rata' => $rata
        ]);

        return redirect('/')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $item = SisaMakanan::findOrFail($id);
        return view('edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = SisaMakanan::findOrFail($id);

        if ($request->hasFile('foto')) {

            if ($item->foto && Storage::exists('public/' . $item->foto)) {
                Storage::delete('public/' . $item->foto);
            }

            $fotoPath = $request->file('foto')->store('foto', 'public');
        } else {
            $fotoPath = $item->foto;
        }

        $rata = (
            $request->nasi +
            $request->hewani +
            $request->nabati +
            $request->sayur +
            $request->buah
        ) / 5;

        $item->update([
            'tanggal' => $request->tanggal,
            'nama' => $request->nama,
            'petugas' => $request->petugas,
            'ruangan' => $request->ruangan,
            'nasi' => $request->nasi,
            'hewani' => $request->hewani,
            'nabati' => $request->nabati,
            'sayur' => $request->sayur,
            'buah' => $request->buah,
            'foto' => $fotoPath,
            'rata_rata' => $rata
        ]);

        return redirect('/')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $item = SisaMakanan::findOrFail($id);

        if ($item->foto && Storage::exists('public/' . $item->foto)) {
            Storage::delete('public/' . $item->foto);
        }

        $item->delete();

        return redirect('/')->with('success', 'Data berhasil dihapus');
    }

    public function export(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        return Excel::download(
            new SisaMakananExport($tanggal_awal, $tanggal_akhir),
            'data_sisa_makanan.xlsx'
        );
    }
}