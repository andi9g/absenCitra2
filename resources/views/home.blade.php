@extends('layouts.master')

@section('warnahome', 'active')


@section('mystyle')
    <style>
        .bakcgroundku {
            background: url('/gambar/logo.jpeg'),
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2 class="my-0 py-0">Logo</h2>
                </div>
                <div class="card-body">
                    <img src="{{ url('gambar/logo.jpeg', []) }}" alt="" width="100%">
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="my-0 py-0">Visi & Misi</h2>
                </div>

                <div class="card-body backgroundku">
                    <h2 class="my-0 py-0">Visi</h2>
                    <p>
                        Terwujudnya peserta didik "Berakhlak mulia, unggul dalam prestasi,berwawasan lingkungan dan berbudaya melayu."
                    </p>
                    {{-- <h2 class="my-0 py-0"> --}}
                    <br>
                    <h2 class="my-0 py-0">Misi</h2>
                    <ol>
                        <li>
                            <p>
                                Mewujudkan mutu kelulusan dengan rata-rata UNBK 7,50, dengan mengembangkan pembelajaran HOTS, PPK, Literasi untuk memenuhi tuntutan dunia kerja
                            </p>
                        </li>

                        <li>
                            <p>
                                Mewujudkan prestasi OSN, FLS2N, OLSN, dan O2SN Tingkat Kota,Provinsi dan Nasional melalui kegiatan OSIS yang terprogram.
                            </p>
                        </li>

                        <li>
                            <p>
                                Mewujudkan kegiatan PPK melalui kegiatan keagamaan yang terprogram dan berkelanjutan dengan mengutamakan kesetaraan gender.
                            </p>
                        </li>

                        <li>
                            <p>
                                Mewujudkan budaya senyum, Sapa, Salam (3S), dan menegakkan disiplin sekolah secara berkelanjutan.
                            </p>
                        </li>

                        <li>
                            <p>
                                Mewujudkan warga sekolah yang sadar dan peduli terhadap lingkungan.
                            </p>
                        </li>
                        <li>
                            <p>
                                Mewujudkan suasana pembelajaran yang bersih, nyaman, dan ramah lingkungan.
                            </p>
                        </li>
                        <li>
                            <p>
                                Mewujudkan warga sekolah yang berkomitmen untuk menjaga kelestarian dan mencegah kerusakan lingkungan hidup.
                            </p>
                        </li>
                    </ol>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
