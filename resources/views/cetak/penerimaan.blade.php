@extends('layouts.cetak')
@section('content')
    <h3 class="text-center">
        <strong>BERITA ACARA PENERIMAAN BLANGKO IJAZAH</strong>
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
        @if(!$disprov)
        <tr>
            <td class="p0">Kab/Kota</td>
            <td>: {{ $data ? $data->kabupaten : '-' }}</td>
        </tr>
        @endif
        <tr>
            <td class="p0">Provinsi</td>
            <td>: {{ $data ? $data->provinsi : '-' }}</td>
        </tr>
        @if($fire)
        <tr>
            <td class="p0">Negara</td>
            <td>: {{ $data ? $data->negara : '-' }}</td>
        </tr>
        @endif
    </table>
    <p class="mt-1">Dengan ini menyatakan telah menerima Blangko Ijazah dengan rincian sebagai berikut:</p>
    <table class="table table-bordered">
        <tr>
            <td rowspan="3" width="40%">Blangko Ijazah SMK Program 3 Tahun</td>
        </tr>
        <tr>
            <td>{{ ($blangko_3_tahun) ? $blangko_3_tahun->jumlah.' lembar Blangko Ijazah' : '-' }}</td>
        </tr>
        <tr>
            <td>
                {{ ($blangko_3_tahun) ? 'M-SMK/K13-3/23/'.padLeft($blangko_3_tahun->start) : '-' }} 
                <br>s/d<br>
                {{ ($blangko_3_tahun) ? 'M-SMK/K13-3/23/'.padLeft($blangko_3_tahun->end) : '-' }}
            </td>
        </tr>
        <tr>
            <td rowspan="3">Blangko Ijazah SMK Program 4 Tahun</td>
        </tr>
        <tr>
            <td>{{ ($blangko_4_tahun) ? $blangko_4_tahun->jumlah : '-' }} lembar Blangko Ijazah</td>
        </tr>
        <tr>
            <td>
                {{ ($blangko_4_tahun) ? 'M-SMK/K13-4/23/'.padLeft($blangko_4_tahun->start) : '-' }} 
                <br>s/d<br>
                {{ ($blangko_4_tahun) ? 'M-SMK/K13-4/23/'.padLeft($blangko_4_tahun->end) : '-' }}
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="50%"></td>
            <td class="text-center" width="50%">
                {{ $data ? $data->kabupaten : '-' }}
                <br>
                {{ $data ? $data->jabatan : '-' }}
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
