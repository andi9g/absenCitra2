<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Absen;
use App\Models\Mapel;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class laporanC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $mapel = Mapel::join('guru', 'guru.idmapel', 'mapel.idmapel')
        ->select('mapel.idmapel', 'mapel.namamapel')->get();

        $kelas = Kelas::get();
        return view('laporan',[
            'kelas' => $kelas,
            'mapel' => $mapel,
        ]);
    }

    public function cetak(Request $request)
    {
        $request->validate([
            'tanggalawal' => 'required',
            'tanggalakhir' => 'required',
        ]);

        $awal = strtotime(date('Y-m-d', strtotime($request->tanggalawal)));
        $akhir = strtotime(date('Y-m-d', strtotime($request->tanggalakhir)));

        $tglHari = [];
        for ($i=$awal; $i <= $akhir; $i = $i + strtotime("+1 days",strtotime($i))) {
            $hari = Carbon::parse(date('Y-m-d', $i))->isoFormat('dddd');
            if ($hari !== "Minggu") {
                $tglHari[] = date('d', $i);
            }
        }

        if(empty($request->mapel)) {
            $mapel = "";
        }else {
            $mapel = "Pelajaran ".Mapel::where('idmapel', $request->mapel)->first()->namamapel;
        }

        // $tanggalawal = Carbon::parse($awal);
        // $tanggalakhir = Carbon::parse($akhir);
        // $selisihhari = $tanggalawal->diffInDays($tanggalakhir);
        $k = empty($request->kelas)?"":$request->kelas;

        $kelas = Kelas::where('idkelas', 'like', "$k%")->get();

        $dataKelas = [];
        foreach ($kelas as $kls) {
            $siswa = Siswa::join('kelas', 'kelas.idkelas', 'siswa.idkelas')
            ->where('siswa.idkelas', $kls->idkelas)
            ->select('siswa.*', 'kelas.namakelas')
            ->get();

            $dataSiswa = [];
            foreach ($siswa as $sis) {

                $dataKet =[];
                $total = 1;
                for ($i=$awal; $i <= $akhir; $i = $i + strtotime("+1 days",strtotime($i))) {
                    $tanggal = date('Y-m-d', $i);
                    $hari = Carbon::parse(date('Y-m-d', $i))->isoFormat('dddd');
                    if ($hari !== "Minggu" && $hari !== "Sabtu") {
                        
                        if(Auth::user()->idposisi == 2) {

                            $absen = Absen::join('siswa', 'siswa.nis', 'absen.nis')
                            ->join('kelas', 'siswa.idkelas', 'kelas.idkelas')
                            ->join('absenguru', 'absenguru.idabsen', 'absen.idabsen')
                            ->where('siswa.idkelas', $kls->idkelas)
                            ->where('siswa.nis', $sis->nis)
                            ->where('absenguru.tanggalabsen', $tanggal)
                            ->where('absenguru.idmapel', $request->mapel)
                            ->select('absenguru.ket');
                        }else {
                            $absen = Absen::join('siswa', 'siswa.nis', 'absen.nis')
                            ->join('kelas', 'siswa.idkelas', 'kelas.idkelas')
                            ->where('siswa.idkelas', $kls->idkelas)
                            ->where('siswa.nis', $sis->nis)
                            ->where('absen.tanggalabsen', $tanggal)
                            ->select('absen.ket');
                        }
                        


                        if($absen->count() > 0) {
                            $dataKet[] = $absen->first()->ket;
                        }else {
                            $dataKet[] = 'Alfa';
                        }
                        $total++;
                    }

                }

            $dataSiswa[] = [
                'nama' => $sis->namasiswa,
                'jk' => $sis->jk,
                'ket' => $dataKet,
            ];

            }

            $dataKelas[] = [
                'kelas' => $kls->namakelas,
                'data' => $dataSiswa,
            ];

        }

        $dataColect = collect($dataKelas);

        $pdf = PDF::loadView('laporan.laporan', [
            'data' => $dataColect,
            'tglHari' => $tglHari,
            'awal' => $awal,
            'akhir' => $akhir,
            'mapel' => $mapel,
        ])->setPaper('A4','lanscape');

        return $pdf->stream('laporan.pdf');




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        //
    }
}
