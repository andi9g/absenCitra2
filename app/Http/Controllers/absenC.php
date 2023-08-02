<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Kelas;
use App\Models\Siswa;
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

        return view('absenSiswa', [
            'data' => $data,
            'kelas' => $kelas,
            'keyword' => $keyword,
        ]);

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
