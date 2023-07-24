@extends('layouts.master')

@section('judul', 'Pengaturan')
@section('warnapengaturan', 'active')


@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Data Kelas</h3>
                </div>

                <div class="card-body">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#tambahkelas">
                      Tambah Data Kelas
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="tambahkelas" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Kelas</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="{{ route('kelas.store', []) }}" method="post">
                                    @csrf

                                    <div class="modal-body">
                                        <div class='form-group'>
                                            <label for='fornamakelas' class='text-capitalize'>Nama Kelas</label>
                                            <input type='text' name='namakelas' id='fornamakelas' class='form-control' placeholder='masukan namaplaceholder'>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table class="table tabe-striped-table-sm">
                        <thead>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Aksi</th>
                        </thead>

                        <tbody>
                            @foreach ($kelas as $item)

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->namakelas}}</td>
                                <td>
                                    <form action="{{ route('kelas.destroy', [$item->idkelas]) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="badge badge-danger border-0 py-1">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="badge badge-primary border-0 py-1" data-toggle="modal" data-target="#editkelas{{$item->idkelas}}">
                                      <i class="fa fa-edit"></i>
                                    </button>


                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="editkelas{{$item->idkelas}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Kelas</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <form action="{{ route('kelas.update', [$item->idkelas]) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class='form-group'>
                                                    <label for='fornamakelas' class='text-capitalize'>Nama Kelas</label>
                                                    <input type='text' name='namakelas' id='fornamakelas' class='form-control' placeholder='masukan namaplaceholder' value="{{$item->namakelas}}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        {{-- //-------------// --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Data Mapel</h3>
                </div>

                <div class="card-body">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#tambahmapel">
                      Tambah Data Mapel
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="tambahmapel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Mapel</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="{{ route('mapel.store', []) }}" method="post">
                                    @csrf

                                    <div class="modal-body">
                                        <div class='form-group'>
                                            <label for='fornamamapel' class='text-capitalize'>Nama Mapel</label>
                                            <input type='text' name='namamapel' id='fornamamapel' class='form-control' placeholder='masukan namaplaceholder'>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table class="table tabe-striped-table-sm">
                        <thead>
                            <th>No</th>
                            <th>Nama Mapel</th>
                            <th>Aksi</th>
                        </thead>

                        <tbody>
                            @foreach ($mapel as $item)

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->namamapel}}</td>
                                <td>
                                    <form action="{{ route('mapel.destroy', [$item->idmapel]) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="badge badge-danger border-0 py-1">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="badge badge-primary border-0 py-1" data-toggle="modal" data-target="#editmapel{{$item->idmapel}}">
                                      <i class="fa fa-edit"></i>
                                    </button>


                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="editmapel{{$item->idmapel}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Mapel</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <form action="{{ route('mapel.update', [$item->idmapel]) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class='form-group'>
                                                    <label for='fornamamapel' class='text-capitalize'>Nama Mapel</label>
                                                    <input type='text' name='namamapel' id='fornamamapel' class='form-control' placeholder='masukan namaplaceholder' value="{{$item->namamapel}}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-md-6"></div>
    </div>
@endsection
