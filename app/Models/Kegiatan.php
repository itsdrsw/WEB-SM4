<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $primaryKey = 'idkegiatan';

    protected $table = 'kegiatan';

    protected $guarded = ['idkegiatan'];

    protected $fillable = ['status_kegiatan','proposal_kegiatan','dana_cair'];
}
