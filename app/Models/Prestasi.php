<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'idprestasi';

    protected $table = 'prestasi';

    protected $guarded = ['idprestasi'];

    protected $fillable = [
        'namalomba',
        'sertifikat',
        'dokumentasi',
        'statusprestasi',
        'kategorilomba',
        'tanggallomba',
        'juara',
        'penyelenggara',
        'lingkup',
        'note'
    ];
}
