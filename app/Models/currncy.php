<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class currncy extends Model
{
    use HasFactory;

    protected $table='currncies';
    protected $fillable=[
        'currncy_code',
        'exchange_rate',
    ];
}
