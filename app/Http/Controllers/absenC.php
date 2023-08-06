<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Absenguru;
use App\Models\Mapel;
use App\Models\Guru;
use Auth;
use Illuminate\Http\Request;

class absenC extends Controller
{

    public function tampil(Request $request)
    {
        $kelas = Kelas::get();


        return view('absen', [
            'kelas' => $kelas
        ]);
    }

    public function dataabsen(Request $request)
    {

        $tanggal = empty($request->tanggal)?date('Y-m-d'):date('Y-m-d',strtotime($request->tanggal));
        $keyword = empty($request->keyword)?"":$request->keyword;
        
        $absensi = Absen::join('siswa', 'siswa.nis', 'absen.nis')
        ->join('kelas', 'kelas.idkelas', 'siswa.idkelas')
        ->where('absen.tanggalabsen', $tanggal)
        ->where(function ($query) use ($keyword, $tanggal){
            $query->where('siswa.nis', 'like', "$keyword%")
            ->where('siswa.namasiswa', 'like', "%$keyword%");
        })
        ->select('siswa.namasiswa', 'kelas.namakelas', 'absen.*')
        ->latest()->paginate(15);

        $absensi->appends($request->all());

        // dd(url()->full());


        return view('dataabsensi', [
            'absensi' => $absensi,
            'tanggal' => $tanggal,
            'keyword' => $keyword,
        ]);
    }

    

    public function data(Request $request, $idkelas)
    {

        $keyword = empty($request->keyword)?"":$request->keyword;
        if(Auth::user()->idposisi == 2 || Auth::user()->idposisi == 3){
            $data = Siswa::where('idkelas', $idkelas)->orderBy('namasiswa', 'asc')
            ->where('namasiswa', 'like', "%$keyword%")->get();
        }else {
            $email = Auth::user()->email;
            $idkelas = Siswa::where('email', $email)->first()->idkelas;
            $data = Siswa::where('idkelas', $idkelas)->orderBy('namasiswa', 'asc')
            ->where('namasiswa', 'like', "%$keyword%")->get();
        }

        $kelas = Kelas::where('idkelas',$idkelas)->first();

        $mapel = [];
        if(Auth::user()->idposisi == 2) {
            $mapel = Mapel::join('guru', 'guru.idmapel', 'mapel.idmapel')
            ->where('guru.email', Auth::user()->email)
            ->select("mapel.idmapel", 'mapel.namamapel')->get();
        }

        return view('absenSiswa', [
            'data' => $data,
            'kelas' => $kelas,
            'keyword' => $keyword,
            'mapel' => $mapel,
        ]);

    }

    public function sinkron(Request $request, $idkelas)
    {
        $idguru = Guru::where('email', Auth::user()->email)->first()->idguru;
        // dd($idguru);
        $idmapel = $request->mapel;
        $idkelas = $idkelas;
        $tanggal = date("Y-m-d", strtotime($request->tanggal));


        $data = Absen::join('siswa', 'siswa.nis', 'absen.nis')
        ->where('absen.tanggalabsen', $tanggal)
        ->select('absen.*')
        ->get();

        foreach ($data as $absen) {
            $cek = Absenguru::where('idabsen', $absen->idabsen)
            ->where('idguru', $idguru)
            ->count();
            
            if($cek === 0){
                $tambah = new Absenguru;
                $tambah->idguru = $idguru;
                $tambah->idmapel = $idmapel;
                $tambah->idabsen = $absen->idabsen;
                $tambah->nis = $absen->nis;
                $tambah->ket = $absen->ket;
                $tambah->tanggalabsen = $absen->tanggalabsen;
                $tambah->created_at = $absen->created_at;
                $tambah->save();
                return redirect()->back()->with('toast_success', 'Sinkron berhasil');
            }else {
                Absenguru::where('idabsen', $absen->idabsen)
                ->where('tanggalabsen', $tanggal)
                ->update([
                    'ket' => $absen->ket,
                ]);
                return redirect()->back()->with('toast_success', 'Sinkron berhasil');
            }
        }
        return redirect()->back()->with('toast_success', 'Tidak ada data disinkonkan');


    }

    public function absen(Request $request, $nis)
    {
        // try{
            $ket = $request->ket;

            $cek = Absen::where('nis', $nis)->where('tanggalabsen', date('Y-m-d'));
            if($cek->count() > 0){
                //update
                if(Auth::user()->idposisi == 2 || Auth::user()->idposisi == 3){
                    $cek->update([
                        'ket' => $ket,
                    ]);
                }else {
                    return redirect()->back()->with('warning', 'Maaf, absensi hanya dapat dilakukan sekali, untuk merubah keterangan yang salah silahkan hubungi guru pembelajaran atau guru piket');
                }


            }else {
                //create
                Absen::create([
                    'nis' => $nis,
                    'ket' => $ket,
                    'tanggalabsen' => date('Y-m-d'),
                ]);
            }
            return redirect()->back()->with('toast_success', 'success');

        // }catch(\Throwable $th){
        //     return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        // }
    }
}
