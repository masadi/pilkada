<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilu extends Model
{
    use HasFactory;
    protected $table = 'pemilu';
	protected $guarded = [];
    public function paslon()
    {
        return $this->hasMany(Paslon::class);
    }
    public function hak_pilih()
    {
        return $this->hasOne(HakPilih::class);
    }
    public function suara()
    {
        return $this->hasOne(Suara::class);
    }
    public function surat_suara()
    {
        return $this->hasOne(SuratSuara::class);
    }
}
