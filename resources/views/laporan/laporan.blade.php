<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
    <link rel="stylesheet" href="styles.css" media="print">
    <style>
        @page {
            margin: 0.2cm 1cm;
        }
        @media print {
        body {
            margin: 0;
            padding: 0;
        }
        }
        body {
            font-size: 9pt;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }
        .collapse {
            border-collapse: collapse;
        }
        .judul {
            font-size: 10pt;
            background: rgb(219, 219, 219);
        }
        .hijau {
            background: rgb(131, 255, 131)
        }
        .merah {
            background: rgb(255, 165, 165)
        }
        .kuning {
            background: rgb(255, 249, 165)
        }
        .ket {
            font-size: 5pt;
        }
        h1,p,h3 {
            margin: 0 auto;
        }
    </style>
</head>
<body>

    <table width="100%" style="border-bottom: 2px solid;margin-bottom: 5px">
        <tr>
            <td width="85px">
                <img src="{{ url('gambar/logo.jpeg', []) }}" width="80px" alt="">
            </td>
            <td valign="top">
                <br>
                <h1>SMPN 5 TANJUNGPINANG</h1>
                <p>Jl. Ir. H. Juanda No. 3, Bukit Bestari, Tj. Pinang Timur, Kec. Bukit Bestari, Kota Tanjung Pinang, Kepulauan Riau</p>
                <h3>Laporan Kehadiran @if ($mapel != "")
                    | {{ $mapel }}
                @endif</h3>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td colspan="3">Cetak Berdasarkan</td>
        </tr>
        <tr>
            <td>{{date('d/m/Y', $awal)." s/d ".date('d/m/Y', $akhir)}}</td>
        </tr>
    </table>

    <table width="100%" class="collapse" border="1">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama</th>
                <th rowspan="2">Jk</th>
                <th colspan="{{count($tglHari)}}">Absen</th>
                <th rowspan="2">H</th>
                <th rowspan="2">I</th>
                <th rowspan="2">S</th>
                <th rowspan="2">A</th>
            </tr>
            <tr>
                @foreach ($tglHari as $item)
                    <th>{{$item}}</th>
                @endforeach
            </tr>
        </thead>


        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td colspan="{{count($tglHari) + 7}}" class="judul">Kelas {{$item['kelas']}}</td>
                </tr>
                @foreach ($item['data'] as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data['nama']}}</td>
                        <td>{{($data['jk']=="L")?"Laki-laki":"Perempuan"}}</td>
                        @php
                            $h=0;
                            $i=0;
                            $s=0;
                            $a=0;
                        @endphp
                        @foreach ($data['ket'] as $ket)
                            <td class="ket @if ($ket=="Hadir")
                                hijau
                                @elseif ($ket=="Izin")
                                putih
                                @elseif ($ket=="Sakit")
                                kuning
                                @elseif ($ket=="Alfa")
                                merah
                                @endif">
                                @if ($ket=="Hadir")
                                H
                                @php
                                    $h++;
                                @endphp
                                @elseif ($ket=="Izin")
                                I
                                @php
                                    $i++;
                                @endphp
                                @elseif ($ket=="Sakit")
                                S
                                @php
                                    $s++;
                                @endphp
                                @elseif ($ket=="Alfa")
                                A
                                @php
                                    $a++;
                                @endphp
                                @endif
                            </td>
                        @endforeach
                        <td align="center">{{$h}}</td>
                        <td align="center">{{$i}}</td>
                        <td align="center">{{$s}}</td>
                        <td align="center">{{$a}}</td>
                    </tr>

                @endforeach
            @endforeach
        </tbody>

    </table>

    <br>

    <table width="100%">
        <tr>
            <td width="70%"></td>
            <td>
                <table>
                    <tr>
                        <td>Tanjungpinang, {{\Carbon\Carbon::parse(date('Y-m-d'))->isoFormat('DD MMMM Y')}}</td>
                    </tr>
                    <tr>
                        <td>Mengetahui</td>
                    </tr>
                    <tr><td><br><br><br><br></td></tr>
                    <tr>
                        <td>_________________________</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>
