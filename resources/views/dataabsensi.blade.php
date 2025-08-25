@extends('layouts.master')

@section('judul', 'Data Absen')
@section('warnadataabsen', 'active')


@section('content')

<!-- Modal -->
<div class="modal fade" id="tambahAbsen" role="dialog" aria-labelledby="tambahabsen" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Absen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tambahabsen', []) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class='form-group'>
                        <label for='forket' class='text-capitalize'>Keterangan</label>
                        <div class="container-fluid">
                            <select class="select2-nis" required id="select2-nis" name="nis" style="width:100%">
                                <option>Silahkan Dipilih</option>
                                @foreach ($siswa as $s)
                                <option value="{{ $s->nis }}">{{ $s->nis." - ".$s->namasiswa }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='forket' class='text-capitalize'>Keterangan</label>
                        <select name='ket' id='forket' class='form-control'>
                            <option value='Hadir'>Hadir</option>
                            <option value='Izin'>Izin</option>
                            <option value='Sakit'>Sakit</option>
                            <option value='Alfa'>Alfa</option>
                        <select>
                    </div>

                    <div class='form-group'>
                        <label for='fortanggal' class='text-capitalize'>Tanggal</label>
                        <input type='date' value="{{ date("Y-m-d") }}" name='tanggalabsen' id='fortanggal' class='form-control' placeholder='masukan namaplaceholder'>
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
    <form action="{{ url()->current() }}" method="GET">
    <div class="row">
        <div class="col-md-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#tambahAbsen">
              Tambah Absen
            </button>

        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                        <div class="form-group">
                            <input type="date" onchange="submit()" name="tanggal" value="{{ $tanggal }}" class="form-control">
                        </div>

                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                    <input type="text" class="form-control" value="{{ $keyword }}" placeholder="nim or name" aria-label="Recipient's username" name="keyword" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                  </div>
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
                                <th width="5px">No</th>
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


@section('jsku')
<script>
    $(document).ready(function() {
        $('.select2-nis').select2();
    });
</script>
@endsection
