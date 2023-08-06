<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absenguru extends Model
{
    use HasFactory;
    protected $primaryKey="idabsenguru";
    protected $table="absenguru";
    protected $guarded = [];

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'nis', 'nis');
    }
}
