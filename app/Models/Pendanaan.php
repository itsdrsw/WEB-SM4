<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendanaan extends Model
{
    use HasFactory;

    protected $primaryKey = 'idpendanaan';

    protected $table = 'pendanaan';

    protected $guarded = ['idpendanaan'];

    protected $fillable = ['periode','status_anggaran','anggaran_tersedia','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
