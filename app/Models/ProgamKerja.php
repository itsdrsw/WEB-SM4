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
}
