<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Auth;

class profileC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request)
    {
        $id = Auth::user()->id;
        
        $user = User::where('id', $id)->first();

        return view('profile', [
            'user' => $user,
        ]);

    }

    public function ubah(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $id = Auth::user()->id;
        $name = $request->name;
        $user = User::where('id', $id)->first();
        
        $user->update([
            'name' => $name,
        ]);

        $user = User::where('id', $id)->first();
        Auth::attempt($user->toArray());
        
        return redirect()->back()->with('success', 'success')->withInput();

    }

    public function password(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6',
        ]);

        $id = Auth::user()->id;
        $password = Hash::make($request->password);
        
        $user = User::where('id', $id)->first();
        $user->update([
            'password' => $password,
        ]);

        Auth::logout();
        return redirect('login')->with('success', 'success')->withInput();

    }

    public function gambar(Request $request)
    {

        // try {
            if($request->hasFile('gambar')) {
                $gambar = $request->gambar;
                $size = $gambar->getSize();
                $name = $gambar->getClientOriginalName();
                $ex = $gambar->getClientOriginalExtension();
                $ex2 = strtolower($ex);
                $name = uniqid().".".$ex;

                if($size < 2000000) {
                    if($ex2 == 'jpeg' || $ex2 == 'jpg' || $ex2 == 'png') {
                        $gambar->move(public_path()."/gambar/profile", $name);

                        $id = Auth::user()->id;
                        $password = Hash::make($request->password);
                        
                        $user = User::where('id', $id)->first();
                        $user->update([
                            'avatar' => $name,
                        ]);

                        $user = User::where('id', $id)->first();
                        Auth::attempt($user->toArray());
                        return redirect()->back()->with('success', 'success')->withInput();
                    }
                }
                
            }
            return redirect()->back()->with('error', 'error')->withInput();
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with('error', 'error')->withInput();
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
        //
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
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
