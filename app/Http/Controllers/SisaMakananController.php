<?php

namespace App\Http\Controllers;

use App\Models\SisaMakanan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SisaMakananExport;

class SisaMakananController extends Controller
{
    // =========================
    // DASHBOARD (GRAFIK)
    // =========================
    public function dashboard()
    {
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
            'bulan',
            'avgNasi',
            'avgHewani',
            'avgNabati',
            'avgSayur',
            'avgBuah'
        ));
    }

    // =========================
    // TABEL DATA
    // =========================
    public function index()
    {
        $data = SisaMakanan::latest()->get();
        return view('tabel', compact('data'));
    }

    // =========================
    // FORM TAMBAH
    // =========================
    public function create()
    {
        return view('tambah');
    }

    // =========================
    // SIMPAN DATA
    // =========================
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

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('foto'), $namaFile);

            $fotoPath = 'foto/'.$namaFile;
        }

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

        return redirect()->route('tabel')->with('success', 'Data berhasil disimpan');
    }

    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $item = SisaMakanan::findOrFail($id);
        return view('edit', compact('item'));
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $item = SisaMakanan::findOrFail($id);

        $fotoPath = $item->foto;

        if ($request->hasFile('foto')) {

            $oldPath = public_path($item->foto);

            if ($item->foto && file_exists($oldPath)) {
                unlink($oldPath);
            }

            $file = $request->file('foto');
            $namaFile = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('foto'), $namaFile);

            $fotoPath = 'foto/'.$namaFile;
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

        return redirect()->route('tabel')->with('success', 'Data berhasil diupdate');
    }

    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        $item = SisaMakanan::findOrFail($id);

        $path = public_path($item->foto);

        if ($item->foto && file_exists($path)) {
            unlink($path);
        }

        $item->delete();

        return redirect()->route('tabel')->with('success', 'Data berhasil dihapus');
    }

    // =========================
    // EXPORT EXCEL
    // =========================
    public function export(Request $request)
    {
        return Excel::download(
            new SisaMakananExport(
                $request->tanggal_awal,
                $request->tanggal_akhir
            ),
            'data_sisa_makanan.xlsx'
        );
    }
}