<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Pemilu;
use App\Models\Tps;
use App\Models\HakPilih;
use App\Models\SuratSuara;
use App\Models\Suara;
use App\Models\User;
use App\Models\Paslon;

class DashboardController extends Controller
{
   public function index()
   {
      $data = [
         'user' => User::with(['tps.desa.kecamatan'])->find(request()->user()->user_id),
         'pemilu' => Pemilu::with([
            'paslon' => function($query){
               $query->orderBy('nomor_urut');
            },
            'hak_pilih' => function($query){
               $query->where('tps_id', request()->user()->tps_id);
            },
            'suara' => function($query){
               $query->where('tps_id', request()->user()->tps_id);
            },
            'surat_suara' => function($query){
               $query->where('tps_id', request()->user()->tps_id);
            }
         ])->orderBy('id')->get(),
      ];
      return response()->json($data);
   }
   public function store(){
      request()->validate(
         [
            'data_pemilih.dpt_l.'.request()->id => 'required',
            'data_pemilih.dpt_p.'.request()->id => 'required',
            'pengguna_hak_pilih.dpt_l.'.request()->id => 'required',
            'pengguna_hak_pilih.dpt_p.'.request()->id => 'required',
            'pengguna_hak_pilih.dpt_bl.'.request()->id => 'required',
            'pengguna_hak_pilih.dpt_bp.'.request()->id => 'required',
            'pengguna_hak_pilih.dpt_kl.'.request()->id => 'required',
            'pengguna_hak_pilih.dpt_kp.'.request()->id => 'required',
            'penggunaan.dikembalikan.'.request()->id => 'required',
         ],
         [
            'data_pemilih.dpt_l.'.request()->id.'.required' => 'tidak boleh kosong',
            'data_pemilih.dpt_p.'.request()->id.'.required' => 'tidak boleh kosong',
            'pengguna_hak_pilih.dpt_l.'.request()->id.'.required' => 'tidak boleh kosong',
            'pengguna_hak_pilih.dpt_p.'.request()->id.'.required' => 'tidak boleh kosong',
            'pengguna_hak_pilih.dpt_bl.'.request()->id.'.required' => 'tidak boleh kosong',
            'pengguna_hak_pilih.dpt_bp.'.request()->id.'.required' => 'tidak boleh kosong',
            'pengguna_hak_pilih.dpt_kl.'.request()->id.'.required' => 'tidak boleh kosong',
            'pengguna_hak_pilih.dpt_kp.'.request()->id.'.required' => 'tidak boleh kosong',
            'penggunaan.dikembalikan.'.request()->id.'.required' => 'tidak boleh kosong',
         ]
      );
      HakPilih::updateOrCreate(
         [
            'pemilu_id' => request()->id,
            'tps_id' => request()->user()->tps_id,
         ],
         [
            'dpt_l' => request()->pengguna_hak_pilih['dpt_l'][request()->id] ?? 0,
            'dpt_p' => request()->pengguna_hak_pilih['dpt_p'][request()->id] ?? 0,
            'dpt_bl' => request()->pengguna_hak_pilih['dpt_bl'][request()->id] ?? 0,
            'dpt_bp' => request()->pengguna_hak_pilih['dpt_bp'][request()->id] ?? 0,
            'dpt_kl' => request()->pengguna_hak_pilih['dpt_kl'][request()->id] ?? 0,
            'dpt_kp' => request()->pengguna_hak_pilih['dpt_kp'][request()->id] ?? 0,
            'dis_l' => request()->disabilitas['dis_l'][request()->id] ?? 0,
            'dis_p' => request()->disabilitas['dis_p'][request()->id] ?? 0,
         ]
      );
      SuratSuara::updateOrCreate(
         [
            'pemilu_id' => request()->id,
            'tps_id' => request()->user()->tps_id,
         ],
         [
            'digunakan' => request()->penggunaan['digunakan'][request()->id] ?? 0,
            'dikembalikan' => request()->penggunaan['dikembalikan'][request()->id] ?? 0,
            'tidak_terpakai' => request()->penggunaan['tidak_terpakai'][request()->id] ?? 0,
         ]
      );
      Suara::updateOrCreate(
         [
            'pemilu_id' => request()->id,
            'tps_id' => request()->user()->tps_id,
         ],
         [
            'sah' => request()->jml_suara_sah[request()->id] ?? 0,
            'tidak_sah' => request()->jml_suara_tidak_sah[request()->id] ?? 0,
         ],
      );
      foreach(request()->suara_sah[request()->id] as $paslon_id => $sah){
         $paslon = Paslon::find($paslon_id);
         $paslon->update([
            'sah' => $sah,
         ]);
      }
      $data = [
         'icon' => 'success',
         'title' => 'Berhasil!',
         'text' => 'Data berhasil disimpan!',
     ];
      return response()->json($data);
   }
}