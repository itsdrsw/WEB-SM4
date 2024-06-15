<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgamKerja extends Model
{
    use HasFactory;

    protected $primaryKey = 'idproker';

    protected $table = 'progam_kerja';

    protected $guarded = ['idproker'];

    protected $fillable = [
        'status_proker',
        'lampiran_proker',
        'nama_proker',
        'penanggung_jawab',
        'uraian_proker',
        'periode',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
