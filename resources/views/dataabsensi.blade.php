@extends('layouts.master')

@section('judul', 'Data Absen')
@section('warnadataabsen', 'active')


@section('content')
<div class="container">
    <form action="{{ url()->current() }}" method="GET">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-4">
                        <div class="form-group">
                            <input type="date" onchange="submit()" name="tanggal" value="{{ $tanggal }}" class="form-control">
                        </div>
                    
                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group mb-3">
                    <input type="text" class="form-control" value="{{ $keyword }}" placeholder="nim or name" aria-label="Recipient's username" name="keyword" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                  </div>
            </div>
        </div>
    </form>


    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered table-sm">
                            <thead>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Ket</th>
                            </thead>
        
                            <tbody>
                                @foreach ($absensi as $item)
                                <tr>
                                    <td>{{ $loop->iteration + $absensi->firstItem() - 1 }}</td>
                                    <td>{{ $item->namasiswa }}</td>
                                    <td>{{ $item->namakelas }}</td>
                                    <td>{{ $item->ket }}</td>
                                </tr>
                                    
                                @endforeach
                            </tbody>
        
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>
@endsection
