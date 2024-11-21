@extends('layouts.cetak')
@section('content')
    <h3 class="text-center">
        <strong>BERITA ACARA PENGGANTIAN BLANGKO IJAZAH</strong>
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
    </table>
    @if (!$fire)
        <p>Yang selanjutnya di sebut PIHAK PERTAMA</p>
        <table>
            <tr>
                <td class="p0">Nama</td>
                <td>: {{ $berita_acara_2 ? $berita_acara_2->nama : '-' }}</td>
            </tr>
            <tr>
                <td class="p0">Jabatan</td>
                <td>: {{ $berita_acara_2 ? $berita_acara_2->jabatan : '-' }}</td>
            </tr>
            <tr>
                <td class="p0">Instansi</td>
                <td>: {{ $berita_acara_2 ? $berita_acara_2->instansi : '-' }}</td>
            </tr>
            <tr>
                <td class="p0">Kab/Kota</td>
                <td>: {{ $berita_acara_2 ? $berita_acara_2->kabupaten : '-' }}</td>
            </tr>
            <tr>
                <td class="p0">Provinsi</td>
                <td>: {{ $berita_acara_2 ? $berita_acara_2->provinsi : '-' }}</td>
            </tr>
        </table>
        <p>Yang selanjutnya di sebut PIHAK KEDUA</p>
        <p class="mt-1 mb-0">Dengan ini menerangkan bahwa, PIHAK PERTAMA menyerahkan Blangko Ijazah yang rusak/salah tulis
            kepada PIHAK KEDUA dengan rincian:</p>
    @endif
    @if ($fire)
        <p class="mt-1">Dengan ini menyatakan bahwa, terdapat Blangko Ijazah yang rusak/salah tulis dengan rincian sebagai
            berikut:</p>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <td class="text-center">No.</td>
                <td class="text-center">Nomor Ijazah</td>
                <td class="text-center">Keterangan Kerusakan/Kesalahan Penulisan</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($baru as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $item->nomor_seri }}</td>
                <td class="text-center">{{ $item->keterangan }}</td>
            </tr>
            @empty
            <tr>
                <td class="text-center" colspan="3">Tidak ada data untuk ditampilkan</td>
            </tr>
            @endforelse
            <tr>
                <td class="text-center">Total</td>
                <td class="text-center">{{ count($baru) }} lembar Blangko Ijazah</td>
                <td class="text-center"></td>
            </tr>
        </tbody>
    </table>
    <p class="mt-1 mb-0" v-show="!fire">Selanjutnya PIHAK KEDUA menyerahkan Blangko Ijazah pengganti kepada PIHAK PERTAMA
        dengan rincian:</p>
    <p class="mt-1 mb-0" v-show="fire">dan dilakukan penggantian dengan Blangko Ijazah yang baru dengan rincian sebagai
        berikut:</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td class="text-center">No.</td>
                <td class="text-center">Nomor Ijazah</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($baru as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $item->nomor_seri_baru }}</td>
            </tr>
            @empty
            <tr>
                <td class="text-center" colspan="2">Tidak ada data untuk ditampilkan</td>
            </tr>    
            @endforelse
            <tr>
                <td class="text-center">Total</td>
                <td class="text-center">{{ count($baru) }} lembar Blangko Ijazah</td>
            </tr>
        </tbody>
    </table>
    @if(!$fire)
    <table class="mt-1" width="100%">
        <tr>
            <td class="text-center" colspan="2">PARA PIHAK,</td>
        </tr>
        <tr>
            <td class="text-center">
                PIHAK PERTAMA;
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                {{ ($data) ? $data->nama : ''}}
            </td>
            <td class="text-center">
                PIHAK KEDUA;
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                {{ ($berita_acara_2) ? $berita_acara_2->nama : '-' }}
            </td>
        </tr>
    </table>
    @endif
    @if($fire)
    <table class="mt-1" width="100%">
        <tr>
            <td class="text-center" width="50%">&nbsp;</td>
            <td class="text-center" width="50%">
                {{ ($data) ? $data->jabatan : '-'}}
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                {{ ($data) ? $data->nama : '-' }}
            </td>
        </tr>
    </table>
    @endif
@endsection
