<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Http\Request;

class pengaturanC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::get();
        $mapel = Mapel::get();

        return view('pengaturan', compact(['kelas', 'mapel']));
    }


    public function store_kelas(Request $request)
    {
        try{
            $data = $request->all();
            Kelas::create($data);
            return redirect('pengaturan')->with('toast_success', 'success');

        }catch(\Throwable $th){
            return redirect('pengaturan')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function store_mapel(Request $request)
    {
        try{
            $data = $request->all();
            Mapel::create($data);
            return redirect('pengaturan')->with('toast_success', 'success');

        }catch(\Throwable $th){
            return redirect('pengaturan')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update_kelas(Request $request, $idkelas)
    {
        try{
            $data = $request->all();
            $update = Kelas::where('idkelas',$idkelas)->first();
            $update->update($data);

            return redirect('pengaturan')->with('toast_success', 'Success');
        }catch(\Throwable $th){
            return redirect('pengaturan')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function update_mapel(Request $request, $idmapel)
    {
        try{
            $data = $request->all();
            $update = Mapel::where('idmapel',$idmapel)->first();
            $update->update($data);

            return redirect('pengaturan')->with('toast_success', 'Success');
        }catch(\Throwable $th){
            return redirect('pengaturan')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy_kelas($idkelas)
    {
        try{
            Kelas::destroy($idkelas);

            return redirect('pengaturan')->with('toast_success', 'Success');

        }catch(\Throwable $th){
            return redirect('pengaturan')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function destroy_mapel($idmapel)
    {
        try{
            Mapel::destroy($idmapel);

            return redirect('pengaturan')->with('toast_success', 'Success');

        }catch(\Throwable $th){
            return redirect('pengaturan')->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
