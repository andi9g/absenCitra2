@extends('layouts.master')

@section('judul', 'Profile')
@section('content')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-5 my-0 py-0">
                <div class="card ">
                    <div class="card-body">
                        <img src="{{ url('gambar/profile', [Auth::user()->avatar]) }}" width="100%" alt="" class="text-center rounded-lg">
                    </div>
                </div>
            </div>
            <div class="col-md-7 my-0 py-0">
                <form action="{{ route('profile.gambar') }}" method="post" enctype="multipart/form-data" class="my-0 py-0">
                    @csrf
                    
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="gambar">Pilih Gambar</label>
                                <input id="gambar" class="form-control" type="file" name="gambar">
                            </div>

                            <button type="submit" class="btn btn-primary text-right">
                                Ubah Gambar
                            </button>
                        </div>
                    </div>
                
                </form>
            </div>
        </div>
        <div class="card">
            <form action="{{ route('profile.ubah') }}" method="post">
            <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="namalengkap">Nama Lengkap</label>
                        <input id="namalengkap" class="form-control" type="text" name="name" value="{{ $user->name }}">
                    </div>
        
                    
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">
                    Update
                </button>
            </div>
            </form>
        </div>

        <div class="card">
            <form method="post" action="{{ route('profile.password') }}">
                @csrf
            <div class="card-body">
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input id="password" class="form-control" type="password" name="password">
                    </div>
                    
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">
                    Update
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
