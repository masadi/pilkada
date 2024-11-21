<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Pemilu;
use App\Models\Tps;
use App\Models\HakPilih;
use App\Models\SuratSuara;
use App\Models\Suara;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $folder = public_path('templates');
        $data_pemilu = [
            [
                'nama' => 'GUBERNUR DAN WAKIL GUBERNUR',
                'paslon' => [
                    [
                        'nama' => 'Hj. LULUK NUR HAMIDAH, M.Si. & H. LUKMANUL KHAKIM, M.Si.', 
                        'nomor_urut' => 1
                    ],
                    [
                        'nama' => 'KHOFIFAH INDAR PARAWANSA & EMIL ELESTIANTO DARDAK', 
                        'nomor_urut' => 2
                    ],
                    [
                        'nama' => 'Dr. (H.C) Ir. TRI RISMAHARINI, M.T. & ZAHRUL AZHAR ASUMTA GUS HANS, S.IP., M. Kes.', 
                        'nomor_urut' => 3
                    ],
                ],
            ],
            [
                'nama' => 'BUPATI DAN WAKIL BUPATI',
                'paslon' => [
                    [
                        'nama' => 'DR. Ir. FATTAH JASIN, M.S. & RP. AHMAD MUJAHID ANSORI, Drs.', 
                        'nomor_urut' => 1
                    ],
                    [
                        'nama' => 'Dr. KH. KHOLILURRAHMAN, S.H., M.Si. & H. SUKRIYANTO', 
                        'nomor_urut' => 2
                    ],
                    [
                        'nama' => 'MUHAMMAD BAQIR AMINATULLAH & TAUFADI, S.H.I.', 
                        'nomor_urut' => 3
                    ],
                ],
            ]
        ];
        Pemilu::truncate();
        Kecamatan::truncate();
        foreach($data_pemilu as $dp){
            $pemilu = Pemilu::create([
                'nama' => $dp['nama']
            ]);
            foreach($dp['paslon'] as $paslon){
                $pemilu->paslon()->create($paslon);
            }
        }
        return (new FastExcel)->import($folder.'/dpt.xlsx', function ($d){
            $kec = Kecamatan::updateOrCreate([
                'nama' => $d['KECAMATAN']
            ]);
            $desa = Desa::updateOrCreate([
                'kecamatan_id' => $kec->id,
                'nama' => $d['KELURAHAN']
            ]);
            $tps = Tps::updateOrCreate([
                'desa_id' => $desa->id,
                'nama' => $d['TPS'],
                'dpt_l' => $d['L'],
                'dpt_p' => $d['P'],
                'tambahan' => $d['PEMILIH'],
            ]);
            //$desa_id = Str::padLeft($desa->id.$d['TPS'], 6, 0);
            //$tps_id = Str::padLeft($desa->id.$d['TPS'], 6, 0);
            $username = Str::padLeft($desa->id.$d['TPS'], 6, 0);
            $this->command->info($username.' : '.$d['KECAMATAN'].'=>'.$d['KELURAHAN'].'=>'.$d['TPS']);
            User::updateOrCreate(
                [
                    'name' => 'TPS '.$d['TPS'],
                    'username' => $username,
                    'email' => $username.'@email.com',
                    'tps_id' => $tps->id,
                ],
                [
                    'password' => bcrypt($username),
                ]
            );
        });
    }
}
