<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable=[
        'guest_id',
        'name',
        'email',
        'phoneNumber',
        'secondPhoneNumber',
    ];

    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }
}
