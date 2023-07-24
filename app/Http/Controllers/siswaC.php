<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class siswaC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = empty($request->cari)?"":$request->cari;
        $searchkelas = empty($request->kelas)?"":$request->kelas;


        $siswa = Siswa::where('namasiswa', 'like', "%$search%")
        ->latest()
        ->where('idkelas', 'like',"$searchkelas%")
        ->paginate(15);

        $siswa->appends($request->all());



        $kelas = Kelas::get();

        return view('siswa', [
            'kelas' => $kelas,
            'siswa' => $siswa,
            'search' => $search,
            'searchkelas' => $searchkelas,
        ]);
    }

    public function reset(Request $request, $email)
    {
         try{
            $data = User::where('email', $email)->first();
            $data2 = Siswa::where('email', $email)->first();
            $password = Hash::make(date('Ymd', strtotime($data2->tanggallahir)));

            $data->update([
                'password' => $password,
            ]);
            return redirect('siswa')->with('success', 'Data berhasil ditambahkan');
            return redirect('guru')->with('success', 'Data berhasil direset <br> Password : '.date('Ymd', strtotime($data2->tanggallahir)));

         }catch(\Throwable $th){
             return redirect('siswa')->with('toast_error', 'Terjadi kesalahan');
         }
    }

    public function ketuakelas(Request $request, $email)
    {
        // try{
            $data = empty((bool)($request->ketuakelas))?0:1;

            $ambil = Siswa::where('email', $email)->first();
            if($data == 1){
                User::where('email', $email)->insert([
                    'name' => $ambil->namasiswa,
                    'email' => $ambil->email,
                    'idposisi' => $data,
                    'password' => Hash::make(date('Ymd', strtotime($ambil->tanggallahir))),
                ]);
                // dd('berhasil');
                $ket = "membuatkan akun ketua kelas";
            }else {
                $ket = "menghapus akun ketua kelas";
                User::where('email', $email)->delete();
            }

            return redirect('siswa')->with('toast_success', 'success, '.$ket);

        // }catch(\Throwable $th){
        //     return redirect('siswa')->with('toast_error', 'Terjadi kesalahan');
        // }
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
        // try{
            $data = $request->all();

            Siswa::create($data);

            return redirect()->back()->with('success', 'Data berhasil ditambahkan');
        // }catch(\Throwable $th){
        //     return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        // }
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
    public function update(Request $request, $idsiswa)
    {
        try{
            $data = $request->all();
            $ubah = Siswa::where('idsiswa', $idsiswa)->first();
            $ubah->update($data);

            return redirect()->back()->with('success', 'Data berhasil diubah');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Siswa::destroy($id);
            return redirect('siswa')->with('toast_warning', 'Data berhasil di hapus');

        }catch(\Throwable $th){
            return redirect('siswa')->with('toast_error', 'Terjadi kesalahan');
        }



    }
}
