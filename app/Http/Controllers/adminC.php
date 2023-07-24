<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Posisi;
use Hash;
use Illuminate\Http\Request;

class adminC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = empty($request->cari)?"":$request->cari;
        $searchposisi = empty($request->posisi)?"":$request->posisi;


        $admin = User::leftJoin('siswa', 'siswa.email', 'users.email')
        ->leftJoin('kelas', 'kelas.idkelas', 'siswa.idkelas')
        ->where('users.name', 'like', "%$search%")
        ->latest()
        ->where('users.idposisi', 'like',"$searchposisi%")
        ->where('users.idposisi', 3)
        ->select('users.*','kelas.namakelas', 'users.email')
        ->paginate(15);

        $admin->appends($request->all());



        $posisi = Posisi::where('idposisi', 3)->get();

        return view('admin', [
            'posisi' => $posisi,
            'admin' => $admin,
            'search' => $search,
            'searchposisi' => $searchposisi,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $data = $request->all();
            $data['password'] = Hash::make('admin'.date('Y'));

            User::create($data);
            return redirect('admin')->with('toast_success', 'success');


        }catch(\Throwable $th){
            return redirect('admin')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function reset(Request $request, $id)
    {
        try{
            $password = Hash::make('admin'.date('Y'));

            User::where('id', $id)->first()
            ->update([
                'password' => $password
            ]);
            return redirect('admin')->with('toast_success', 'success');


        }catch(\Throwable $th){
            return redirect('admin')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->name;
        $idposisi = $request->idposisi;
        $update = User::where('id', $id)->first()
        ->update([
            'name' => $name,
            'idposisi' => $idposisi,
        ]);
        return redirect('admin')->with('toast_success', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            User::destroy($id);
            return redirect('admin')->with('toast_success', 'Success');

        }catch(\Throwable $th){
            return redirect('admin')->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
