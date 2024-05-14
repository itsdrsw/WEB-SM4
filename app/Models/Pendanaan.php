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
}
