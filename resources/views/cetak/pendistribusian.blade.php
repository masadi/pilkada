@extends('layouts.cetak')
@section('content')
    <h3 class="text-center">
        <strong>BERITA ACARA PENDISTRIBUSIAN BLANGKO IJAZAH</strong>
    </h3>
    <p>Pada hari {{ $waktu->hari }} tanggal {{ $waktu->tanggal }} bulan {{ $waktu->bulan }} tahun {{ $waktu->tahun }}, Kami
        yang bertanda tangan dibawah ini:</p>
    <table>
        <tr>
            <td class="p0">Nama</td>
            <td>: {{ $data ? $data->nama : '-' }}</td>
        </tr>
        <tr>
            <td class="p0">Jabatan</td>
            <td>: {{ $data ? $data->jabatan : '-' }}</td>
        </tr>
        <tr>
            <td class="p0">Instansi</td>
            <td>: {{ $data ? $data->instansi : '-' }}</td>
        </tr>
        @if (!$disprov)
            <tr>
                <td class="p0">Kab/Kota</td>
                <td>: {{ $data ? $data->kabupaten : '-' }}</td>
            </tr>
        @endif
        <tr>
            <td class="p0">Provinsi</td>
            <td>: {{ $data ? $data->provinsi : '-' }}</td>
        </tr>
        @if ($fire)
            <tr>
                <td class="p0">Negara</td>
                <td>: {{ $data ? $data->negara : '-' }}</td>
            </tr>
        @endif
        <tr>
            <td class="p0">Penerima Blangko Ijazah</td>
            <td>: <i>TERLAMPIR</i></td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="50%"></td>
            <td class="text-center" width="50%">
                {{ $data ? $data->jabatan.',' : '-' }}
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                {{ $data ? $data->nama : '-' }}
            </td>
        </tr>
    </table>
@endsection
