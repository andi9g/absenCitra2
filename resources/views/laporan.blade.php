@extends('layouts.master')

@section('judul', 'Laporan')
@section('warnalaporan', 'active')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card card-outline card-secondary">
                    <div class="card-header">
                        <h3>Form Cetak</h3>
                    </div>

                    <form action="{{ route('cetak', []) }}" method="get">
                    <div class="card-body">
                        <div class='form-group'>
                            <label for='fortanggalawal' class='text-capitalize'>Mulai Tanggal</label>
                            <input type='date' name='tanggalawal' required id='fortanggalawal' class='form-control' placeholder='masukan namaplaceholder'>
                        </div>

                        <div class='form-group'>
                            <label for='fortanggalakhir' class='text-capitalize'>Sampai Tanggal</label>
                            <input type='date' required name='tanggalakhir' id='fortanggalakhir' class='form-control' placeholder='masukan namaplaceholder'>
                        </div>

                        <div class='form-group'>
                            <label for='forkelas' class='text-capitalize'>Kelas</label>
                            <select name='kelas' id='forkelas' class='form-control'>
                                <option value=''>Semua Kelas</option>
                                @foreach ($kelas as $item)
                                    <option value="{{$item->idkelas}}">{{$item->namakelas}}</option>
                                @endforeach
                            <select>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-print"></i> Cetak
                        </button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
