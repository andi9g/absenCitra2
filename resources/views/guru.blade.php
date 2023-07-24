@extends('layouts.master')

@section('judul', 'Data Guru')
@section('warnaguru', 'active')


@section('content')

<!-- Modal -->
                    <div class="modal fade" id="tambahsiswa" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Form Tambah Guru</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="{{ route('guru.store', []) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class='form-group'>
                                            <label for='fornamasiswa' class='text-capitalize'>Nama Guru</label>
                                            <input type='text' name='namaguru' id='fornamasiswa' class='form-control' placeholder='masukan nama guru'>
                                        </div>

                                        <div class='form-group'>
                                            <label for='foridkelas' class='text-capitalize'>Mapel</label>
                                            <select name='idmapel' id='foridkelas' class='form-control'>
                                                @foreach ($mapel as $item)
                                                    <option value="{{$item->idmapel}}">{{$item->namamapel}}</option>
                                                @endforeach
                                            <select>
                                        </div>

                                        <div class='form-group'>
                                            <label for='foralamat' class='text-capitalize'>Alamat</label>
                                            <input type='text' name='alamat' id='foralamat' class='form-control' placeholder='masukan alamat'>
                                        </div>

                                        <div class='form-group'>
                                            <label for='foremail' class='text-capitalize'>Email</label>
                                            <input type='email' name='email' id='foremail' class='form-control' placeholder='masukan email'>
                                        </div>

                                        <div class='form-group'>
                                            <label for='fortanggallahir' class='text-capitalize'>Tanggal Lahir</label>
                                            <input type='date' name='tanggallahir' id='fortanggallahir' class='form-control' placeholder='masukan tanggal lahir'>
                                        </div>

                                        <div class='form-group'>
                                            <label for='forjk' class='text-capitalize'>Jenis Kelamin</label>
                                            <select name='jk' id='forjk' class='form-control'>
                                                <option value=''>Pilih</option>
                                                <option value='l'>Laki-laki</option>
                                                <option value='p'>Perempuan</option>
                                            <select>
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
                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#tambahsiswa">
                      Tambah Guru
                    </button>
                </div>

                <div class="col-md-2 mb-0 pb-0"></div>
                <div class="col-md-6 mb-0 pb-0">
                    <form action="" class="d-inline mb-0 pb-0">
                    <div class="row mb-0 pb-0">
                        <div class="col-md-5 text-right">
                            <div class='form-group mb-0 pb-0'>
                                <select name='mapel' onchange="submit()" id='forkelas' class='form-control'>
                                    <option value=''>Semua</option>
                                    @foreach ($mapel as $item)
                                        <option value="{{$item->idmapel}}" @if ($item->idmapel == $searchmapel)
                                            selected
                                        @endif>{{$item->namamapel}}</option>
                                    @endforeach
                                <select>
                            </div>

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
                    <th>JK</th>
                    <th>Email</th>
                    <th>Mapel</th>
                    <th>Reset</th>
                    <th>aksi</th>
                </thead>

                <tbody>
                    @foreach ($guru as $item)

                    <tr>
                        <td width="5px">{{$loop->iteration + $guru->firstItem() - 1 }}</td>
                        <td>{{$item->namaguru}}</td>
                        <td>{{($item->jk=="l")?'Laki-Laki':'Perempuan'}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->mapel->namamapel}}</td>
                        <td>
                            <form action="{{ route('guru.reset', [$item->email]) }}" method="post">
                                @csrf
                                <button type="submit" onclick="return confirm('ingim mereset password')" class="badge badge-warning border-0 py-1">
                                    <i class="fa fa-key"></i> Reset Password
                                </button>
                            </form>
                        </td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="badge badge-primary border-0 py-1" data-toggle="modal" data-target="#edit{{$item->idguru}}">
                              <i class="fas fa-edit    "></i> Edit
                            </button>

                            <form action="{{ route('guru.destroy', [$item->idguru]) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapusnya?')" class="badge badge-danger border-0 py-1">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    <div class="modal fade" id="edit{{$item->idguru}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Form Edit</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="{{ route('guru.update', [$item->idguru]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class='form-group'>
                                            <label for='fornis' class='text-capitalize'>NIS</label>
                                            <input type='number' name='nis' id='fornis' class='form-control' placeholder='masukan nis' value="{{$item->nis}}">
                                        </div>

                                        <div class='form-group'>
                                            <label for='fornamasiswa' class='text-capitalize'>Nama Guru</label>
                                            <input type='text' name='namaguru' id='fornamasiswa' class='form-control' placeholder='masukan nama guru' value="{{$item->namaguru}}">
                                        </div>

                                        <div class='form-group'>
                                            <label for='foridkelas' class='text-capitalize'>Mapel</label>
                                            <select name='idmapel' id='foridkelas' class='form-control'>
                                                @foreach ($mapel as $d)
                                                    <option value="{{$d->idmapel}}" @if ($d->idmapel == $item->idmapel)
                                                        selected
                                                    @endif>{{$d->namamapel}}</option>
                                                @endforeach
                                            <select>
                                        </div>

                                        <div class='form-group'>
                                            <label for='foremail' class='text-capitalize'>Email</label>
                                            <input type='email' name='email' id='foremail' class='form-control' placeholder='masukan email' value="{{$item->email}}">
                                        </div>

                                        <div class='form-group'>
                                            <label for='foralamat' class='text-capitalize'>Alamat</label>
                                            <input type='text' name='alamat' id='foralamat' class='form-control' placeholder='masukan alamat' value="{{$item->alamat}}">
                                        </div>

                                        <div class='form-group'>
                                            <label for='fortanggallahir' class='text-capitalize'>Tanggal Lahir</label>
                                            <input type='date' name='tanggallahir' id='fortanggallahir' class='form-control' placeholder='masukan tanggal lahir' value="{{$item->tanggallahir}}">
                                        </div>

                                        <div class='form-group'>
                                            <label for='forjk' class='text-capitalize'>Jenis Kelamin</label>
                                            <select name='jk' id='forjk' class='form-control'>
                                                <option value=''>Pilih</option>
                                                <option value='l' @if ($item->jk == 'L')
                                                    selected
                                                @endif>Laki-laki</option>
                                                <option value='p' @if ($item->jk == 'P')
                                                    selected
                                                @endif>Perempuan</option>
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

            <p><i>
                Login menggunakan gmail, Password guru adalah (TahunBulanTanggal) contoh : <b>20070707</b>
            </i></p>
        </div>


        <div class="card-footer">
            {{$guru->links('vendor.pagination.bootstrap-4')}}
        </div>
    </div>

</div>
@endsection
