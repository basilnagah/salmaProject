<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','desc','image1','image2','image3','image4','image5','quantity','category','price','salePrice','sale'
    ];
}
