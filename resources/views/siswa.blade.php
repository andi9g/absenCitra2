@extends('layouts.master')

@section('judul', 'Data Siswa')
@section('warnasiswa', 'active')


@section('content')

<!-- Modal -->
                    <div class="modal fade" id="tambahsiswa" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Form Tambah Siswa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="{{ route('siswa.store', []) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class='form-group'>
                                            <label for='fornis' class='text-capitalize'>NIS</label>
                                            <input type='text' name='nis' id='fornis' class='form-control' placeholder='masukan nis'>
                                        </div>

                                        <div class='form-group'>
                                            <label for='fornamasiswa' class='text-capitalize'>Nama Siswa</label>
                                            <input type='text' name='namasiswa' id='fornamasiswa' class='form-control' placeholder='masukan nama siswa'>
                                        </div>

                                        <div class='form-group'>
                                            <label for='foridkelas' class='text-capitalize'>Kelas</label>
                                            <select name='idkelas' id='foridkelas' class='form-control'>
                                                @foreach ($kelas as $item)
                                                    <option value="{{$item->idkelas}}">{{$item->namakelas}}</option>
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
                      Tambah Siswa
                    </button>
                </div>

                <div class="col-md-2 mb-0 pb-0"></div>
                <div class="col-md-6 mb-0 pb-0">
                    <form action="" class="d-inline mb-0 pb-0">
                    <div class="row mb-0 pb-0">
                        <div class="col-md-5 text-right">
                            <div class='form-group mb-0 pb-0'>
                                <select name='kelas' onchange="submit()" id='forkelas' class='form-control'>
                                    <option value=''>Semua</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{$item->idkelas}}" @if ($item->idkelas == $searchkelas)
                                            selected
                                        @endif>{{$item->namakelas}}</option>
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
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm table-bordered">
                    <thead>
                        <th>No</th>
                        <th>nis</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Email</th>
                        <th>Kelas</th>
                        <th>Tgl.Lahir</th>
                        <th>Reset</th>
                        <th>aksi</th>
                    </thead>

                    <tbody>
                        @foreach ($siswa as $item)

                        <tr>
                            <td width="5px">{{$loop->iteration + $siswa->firstItem() - 1 }}</td>
                            <td>{{$item->nis}}</td>
                            <td>{{$item->namasiswa}}</td>
                            <td>{{($item->jk=="l")?'Laki-Laki':'Perempuan'}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->kelas->namakelas}}</td>
                            <td>{{$item->tanggallahir}}</td>
                            <td>
                                @php
                                    $ketua = DB::table('users')->where('email', $item->email)->count();
                                @endphp
                                <form action="{{ route('siswa.hapus.ketuakelas', [$item->email]) }}" method="post">
                                    @csrf
                                    <div class='form-group mb-0'>
                                        <select name='ketuakelas' onchange="submit()" id='forketuakelas' class='w-100'>
                                            <option value=''>Pilih</option>
                                            <option value='1' @if ($ketua == 1)
                                                selected
                                            @endif>Ketua Kelas</option>
                                        <select>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="badge badge-primary border-0 py-1" data-toggle="modal" data-target="#edit{{$item->idsiswa}}">
                                  <i class="fas fa-edit    "></i> Edit
                                </button>

                                <form action="{{ route('siswa.destroy', [$item->idsiswa]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapusnya?')" class="badge badge-danger border-0 py-1">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <div class="modal fade" id="edit{{$item->idsiswa}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Form Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <form action="{{ route('siswa.update', [$item->idsiswa]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class='form-group'>
                                                <label for='fornis' class='text-capitalize'>NIS</label>
                                                <input type='number' name='nis' id='fornis' class='form-control' placeholder='masukan nis' value="{{$item->nis}}">
                                            </div>

                                            <div class='form-group'>
                                                <label for='fornamasiswa' class='text-capitalize'>Nama Siswa</label>
                                                <input type='text' name='namasiswa' id='fornamasiswa' class='form-control' placeholder='masukan nama siswa' value="{{$item->namasiswa}}">
                                            </div>

                                            <div class='form-group'>
                                                <label for='foridkelas' class='text-capitalize'>Kelas</label>
                                                <select name='idkelas' id='foridkelas' class='form-control'>
                                                    @foreach ($kelas as $d)
                                                        <option value="{{$d->idkelas}}" @if ($d->idkelas == $item->idkelas)
                                                            selected
                                                        @endif>{{$d->namakelas}}</option>
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

            </div>

            <p><i>
                Login menggunakan gmail, Password Ketua Kelas adalah (TahunBulanTanggal) contoh : <b>20070707</b>
            </i></p>
        </div>


        <div class="card-footer">
            {{$siswa->links('vendor.pagination.bootstrap-4')}}
        </div>
    </div>

</div>
@endsection
