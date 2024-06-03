<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LPJ extends Model
{
    use HasFactory;

    protected $primaryKey = 'idlpj';

    protected $table = 'lpj';

    protected $guarded = ['idlpj'];
}
