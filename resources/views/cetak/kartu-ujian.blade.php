@extends('layouts.cetak')
@section('content')
<table width="{{$lebar}}">
    <tr>
        @foreach ($pd as $item)
            <td style="padding: 0" width="50%">
                <table class="table table-bordered">
                    <tr>
                        <td width="20%" style="border-right: none;">
                            <img src="/img/logo/logo.jpeg" alt="logo" width="60" />
                        </td>
                        <td width="80%" style="border-left: none;">
                            KARTU PESERTA<br>
                            UJIAN AKHIR SEMESTER GANJIL<br>
                            TAHUN PELAJARAN 2024/2024 <br>
                            SMP AL FALAH SUMBER GAYAM
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">foto</td>
                        <td>
                            <table border="0" style="font-size: 11px;">
                                <tr>
                                    <td style="padding: 0; border:none">Nama</td>
                                    <td style="padding: 0; border:none">:</td>
                                    <td style="padding: 0; border:none">
                                        {{ $item->nama }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0; border:none">Kelas</td>
                                    <td style="padding: 0; border:none">:</td>
                                    <td style="padding: 0; border:none">
                                        {{ $item->kelas->nama }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0; border:none">TTL</td>
                                    <td style="padding: 0; border:none">:</td>
                                    <td style="padding: 0; border:none">
                                        {{ $item->tempat_lahir }}, {{ $item->tanggal_lahir }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0; border:none">Username</td>
                                    <td style="padding: 0; border:none">:</td>
                                    <td style="padding: 0; border:none">
                                        {{ $item->nisn }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0; border:none">Password</td>
                                    <td style="padding: 0; border:none">:</td>
                                    <td style="padding: 0; border:none">
                                        {{ $item->user?->default_password }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        @endforeach
    </tr>
</table>
@endsection
