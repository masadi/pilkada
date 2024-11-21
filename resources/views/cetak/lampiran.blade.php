@extends('layouts.cetak')
@section('content')
<h3 class="text-center">
    <strong>LAMPIRAN BERITA ACARA PENDISTRIBUSIAN BLANGKO IJAZAH</strong>
</h3>
@if($disprov)
<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">No.</th>
            <th class="text-center">Kabupaten Kota</th>
            <th class="text-center">Blangko 3 Tahun</th>
            <th class="text-center">Blangko 4 Tahun</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data_lampiran as $item)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $item->nama }}</td>
            <td class="text-center">{{ $item->blangko_3_count }}</td>
            <td class="text-center">{{ $item->blangko_4_count }}</td>
        </tr>
        @empty
        <tr>
            <td class="text-center" colspan="2">Tidak ada data untuk ditampilkan</td>
        </tr>    
        @endforelse
    </tbody>
</table>
@endif
@if($diskab)
<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">No.</th>
            <th class="text-center">Nama</th>
            <th class="text-center">NPSN</th>
            <th class="text-center">Kecamatan</th>
            <th class="text-center">Jumlah PD Lulus</th>
            <th class="text-center">Blangko 3 Tahun</th>
            <th class="text-center">Blangko 4 Tahun</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data_lampiran as $item)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->npsn }}</td>
            <td>{{ $item->kecamatan }}</td>
            <td class="text-center">{{ $item->pd_lulus }}</td>
            <td class="text-center">{{ $item->blangko_3_count }}</td>
            <td class="text-center">{{ $item->blangko_4_count }}</td>
        </tr>
        @empty
        <tr>
            <td class="text-center" colspan="2">Tidak ada data untuk ditampilkan</td>
        </tr>    
        @endforelse
    </tbody>
</table>
@endif
@if($sekolah)
<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">No.</th>
            <th class="text-center">Nama Lengkap</th>
            <th class="text-center">NIS/NISN</th>
            <th class="text-center">Tempat Tanggal Lahir</th>
            <th class="text-center">Nama Orang Tua</th>
            <th class="text-center">Kurikulum</th>
            <th class="text-center">Kompetensi</th>
            <th class="text-center">No Ijazah</th>
            <th class="text-center">Tanggal Terbit Ijazah</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data_lampiran as $item)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->no_induk.'/'.$item->nisn }}</td>
            <td>{{ $item->tempat_lahir.', '.$item->tanggal_lahir_str }}</td>
            <td>{{ $item->nama_ayah }}</td>
            <td class="text-center">{{($item->anggota_rombel->rombongan_belajar->tingkat == 12) ? 'K13-3' : 'K13-4'}}</td>
            <td>{{($item->anggota_rombel->rombongan_belajar->jurusan_sp) ? $item->anggota_rombel->rombongan_belajar->jurusan_sp->nama_jurusan_sp : '-'}}</td>
            <td>{{($item->blangko) ? $item->blangko->nomor_seri : ''}}</td>
            <td>{{($item->blangko) ? $item->blangko->tanggal_str : ''}}</td>
        </tr>
        @empty
        <tr>
            <td class="text-center" colspan="2">Tidak ada data untuk ditampilkan</td>
        </tr>    
        @endforelse
    </tbody>
</table>
@endif
@endsection