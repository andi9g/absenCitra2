<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Mapel;
use Hash;
use Illuminate\Http\Request;

class guruC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = empty($request->cari)?"":$request->cari;
        $searchmapel = empty($request->mapel)?"":$request->mapel;


        $guru = Guru::where('namaguru', 'like', "%$search%")
        ->latest()
        ->where('idmapel', 'like',"$searchmapel%")
        ->paginate(15);

        $guru->appends($request->all());



        $mapel = Mapel::get();

        return view('guru', [
            'mapel' => $mapel,
            'guru' => $guru,
            'search' => $search,
            'searchmapel' => $searchmapel,
        ]);
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



            User::create([
                'name' => $request->namaguru,
                'idposisi' => 2,
                'email' => $request->email,
                'password' => Hash::make(date('Ymd', strtotime($request->tanggallahir))),
            ]);
            Guru::create($data);

            return redirect()->back()->with('success', 'Data berhasil ditambahkan <br> EMAIL : '.$request->email."<br> PASSWORD : ".date('Ymd', strtotime($request->tanggallahir))."<br> Password adalah tanggal lahir TahunBulanTanggal Contoh 20230707");
        // }catch(\Throwable $th){
        //     return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        // }
    }

    public function reset(Request $request, $email)
    {
         try{
            $data = User::where('email', $email)->first();
            $data2 = Guru::where('email', $email)->first();
            $password = Hash::make(date('Ymd', strtotime($data2->tanggallahir)));

            $data->update([
                'password' => $password,
            ]);
            return redirect('guru')->with('success', 'Data berhasil direset <br> Password : '.date('Ymd', strtotime($data2->tanggallahir)));

         }catch(\Throwable $th){
             return redirect('guru')->with('toast_error', 'Terjadi kesalahan');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show(Guru $guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $guru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idsiswa)
    {
        try{
            $data = $request->all();
            $ubah = Guru::where('idsiswa', $idsiswa)->first();
            $ubah->update($data);

            return redirect()->back()->with('success', 'Data berhasil diubah');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Guru::destroy($id);
            return redirect('guru')->with('toast_warning', 'Data berhasil di hapus');

        }catch(\Throwable $th){
            return redirect('guru')->with('toast_error', 'Terjadi kesalahan');
        }



    }
}
