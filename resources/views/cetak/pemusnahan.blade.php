@extends('layouts.cetak')
@section('content')
    <h3 class="text-center">
        <strong>BERITA ACARA PEMUSNAHAN BLANGKO IJAZAH</strong>
    </h3>
    <p>Pada hari {{ $waktu->hari }} tanggal {{ $waktu->tanggal }} bulan {{ $waktu->bulan }} tahun {{ $waktu->tahun }},
        telah dilaksanakan kegiatan pemusnahan Blangko Ijazah oleh:</p>
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
    <p class="mt-1">Yang disaksikan oleh:</p>
    <table>
        <tr>
            <td>Nama</td>
            <td>: {{ $berita_acara_2 ? $berita_acara_2->nama : '-' }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>: {{ $berita_acara_2 ? $berita_acara_2->jabatan : '-' }}</td>
        </tr>
        <tr>
            <td>Instansi</td>
            <td>: {{ $berita_acara_2 ? $berita_acara_2->instansi : '-' }}</td>
        </tr>
        <tr>
            <td>Kab/Kota</td>
            <td>: {{ $berita_acara_2 ? $berita_acara_2->kabupaten : '-' }}</td>
        </tr>
        <tr>
            <td>Provinsi</td>
            <td>: {{ $berita_acara_2 ? $berita_acara_2->provinsi : '-' }}</td>
        </tr>
        @if ($data->negara)
            <tr>
                <td>Negara</td>
                <td>: {{ $data ? $data->negara : '-' }}</td>
            </tr>
        @endif
    </table>
    <table class="mt-1" width="100%">
        <tr>
            <td class="text-center" width="50%">
                {{ $data->jabatan }},
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                {{ $data->nama }}
            </td>
            <td class="text-center" width="50%">
                Saksi,
                <br>
                ({{ ($berita_acara_2) ? $berita_acara_2->instansi : '-' }})
                <br>
                <br>
                <br>
                <br>
                <br>
                {{ ($berita_acara_2) ? $berita_acara_2->nama : '-' }}
            </td>
        </tr>
    </table>
@endsection
