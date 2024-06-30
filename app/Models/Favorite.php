<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'guest_id',
        'product_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function guest()
    {
        return $this->hasOne(Guest::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class);
    }

}
