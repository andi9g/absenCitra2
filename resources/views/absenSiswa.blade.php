@extends('layouts.master')

@section('judul', 'Data Absen '.$kelas->namakelas)
@section('warnaabsen', 'active')


@section('content')
<div class="container">
    <div class="row">
        @foreach ($data as $item)
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2 class="d-inline">{{$item->namasiswa}}</h2>
                </div>
                @php
                    $ket = DB::table('absen')->where('nis', $item->nis)
                    ->where('tanggalabsen', date('Y-m-d'));
                    if($ket->count() > 0) {
                        $ket = $ket->first()->ket;
                    }else {
                        $ket = 'Alfa';
                    }
                @endphp

                <div class="card-footer p-1">
                    <div class='form-group mb-0'>
                        <form action="{{ route('absen.absen', [$item->nis]) }}" method="post">
                            @csrf
                            <select name='ket' id='forket' onchange="submit()" class="form-control rounded-0 @if ($ket=='Hadir')
                                bg-success
                            @elseif ($ket=='Izin')
                                bg-secondary
                            @elseif ($ket=='Sakit')
                                bg-warning
                            @elseif ($ket=='Alfa')
                                bg-danger
                            @endif">
                                <option value='Hadir' @if ($ket=='Hadir')
                                    selected
                                @endif>Hadir</option>
                                <option value='Izin' @if ($ket=='Izin')
                                    selected
                                @endif>Izin</option>
                                <option value='Sakit' @if ($ket=='Sakit')
                                    selected
                                @endif>Sakit</option>
                                <option value='Alfa' @if ($ket=='Alfa')
                                    selected
                                @endif>Alfa</option>
                            <select>

                        </form>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-md-3"></div>

        @endforeach
    </div>
</div>
@endsection
