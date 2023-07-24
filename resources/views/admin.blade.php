@extends('layouts.master')

@section('judul', 'Data Admin')
@section('warnaadmin', 'active')


@section('content')

<!-- Modal -->
<div class="modal fade" id="tambahadmin" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Tambah Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="{{ route('admin.store', []) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class='form-group'>
                        <label for='fornamaadmin' class='text-capitalize'>Nama Admin</label>
                        <input type='text' name='name' id='fornamaadmin' class='form-control' placeholder='masukan nama admin'>
                    </div>

                    <div class='form-group'>
                        <label for='foridposisi' class='text-capitalize'>Posisi</label>
                        <select name='idposisi' id='foridposisi' class='form-control'>
                            @foreach ($posisi as $item)
                                <option value="{{$item->idposisi}}">{{$item->posisi}}</option>
                            @endforeach
                        <select>
                    </div>

                    <div class='form-group'>
                        <label for='foremail' class='text-capitalize'>Email</label>
                        <input type='email' name='email' id='foremail' class='form-control' placeholder='masukan email'>
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
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#tambahadmin">
                      Tambah Admin
                    </button>
                </div>

                <div class="col-md-2 mb-0 pb-0"></div>
                <div class="col-md-6 mb-0 pb-0">
                    <form action="" class="d-inline mb-0 pb-0">
                    <div class="row mb-0 pb-0">
                        <div class="col-md-5 text-right">


                        </div>
                        <div class="col-md-7">
                            <div class="input-group mb-0 pb-0">
                                <input type="text" class="form-control" name="cari" placeholder="masukan pencarian" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{$search}}">
                                <div class="input-group-append">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-search"></i> Cari
                                </button>
                                </div>
                            </div>

                        </div>

                    </div>

                </form>
                </div>
            </div>
        </div>

        <div class="card-header">
            <table class="table table-striped table-hover table-sm table-bordered">
                <thead>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Posisi</th>
                    <th>Reset</th>
                    <th>aksi</th>
                </thead>

                <tbody>
                    @foreach ($admin as $item)

                    <tr>
                        <td width="5px">{{$loop->iteration + $admin->firstItem() - 1 }}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->posisi->posisi}}</td>
                        <td>
                            <form action="{{ route('admin.reset', [$item->id]) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" onclick="return confirm('yakin ingin direset?')" class="badge badge-warning border-0 py-1">
                                    <i class="fa fa-key"> Reset</i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="badge badge-primary border-0 py-1" data-toggle="modal" data-target="#edit{{$item->id}}">
                              <i class="fas fa-edit    "></i> Edit
                            </button>

                            <form action="{{ route('admin.destroy', [$item->id]) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapusnya?')" class="badge badge-danger border-0 py-1">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>


                    <div class="modal fade" id="edit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Form Edit</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="{{ route('admin.update', [$item->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class='form-group'>
                                            <label for='fornamaadmin' class='text-capitalize'>Nama Admin</label>
                                            <input type='text' name='name' id='fornamaadmin' class='form-control' placeholder='masukan nama admin' value="{{$item->name}}">
                                        </div>

                                        <div class='form-group'>
                                            <label for='foremail' class='text-capitalize'>Email</label>
                                            <input type='text' readonly name='email' id='foremail' class='form-control' placeholder='masukan email' value="{{$item->email}}">
                                        </div>

                                        <div class='form-group'>
                                            <label for='foridposisi' class='text-capitalize'>Posisi</label>
                                            <select name='idposisi' id='foridposisi' class='form-control'>
                                                @foreach ($posisi as $d)
                                                    <option value="{{$d->idposisi}}" @if ($d->idposisi == $d->idposisi)
                                                        selected
                                                    @endif>{{$d->posisi}}</option>
                                                @endforeach
                                            <select>
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
            <p>
                <i>
                    Password Admin adalah (admintahun) contoh : <b>admin2023</b>
                </i>
            </p>

        </div>


        <div class="card-footer">
            {{$admin->links('vendor.pagination.bootstrap-4')}}
        </div>
    </div>

</div>
@endsection
