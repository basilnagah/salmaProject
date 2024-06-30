<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class color extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color_code',
    ];

    public function product()
    {
        return $this->hasMany(product::class);
    }

    public function media()
    {
        return $this->hasMany(Medias::class);
    }
}
