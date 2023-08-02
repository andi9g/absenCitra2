@extends('layouts.master')

@section('judul', 'Data Absen')
@section('warnaabsen', 'active')


@section('content')
<div class="container">
    <div class="row">
        @foreach ($kelas as $item)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    @php
                        $total = DB::table('siswa')->where('idkelas', $item->idkelas)->count();
                    @endphp
                    <h2 class="d-inline">Kelas : {{$item->namakelas}}</h2>
                        <div class="btn btn-info btn-xs"><b>{{$total}}</b></div>

                </div>

                <div class="card-footer p-0">
                    <a href="{{ url('absen', [$item->idkelas]) }}" class="btn rounded-0 btn-block btn-success">
                        <b>LIHAT ABSEN</b>
                    </a>
                </div>

            </div>

        </div>

        @endforeach
    </div>
</div>
@endsection
