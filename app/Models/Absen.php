<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;
    protected $primaryKey="idabsen";
    protected $table="absen";
    protected $fillable = ["nis", "ket", "tanggalabsen"];


    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'nis', 'nis');
    }
}
