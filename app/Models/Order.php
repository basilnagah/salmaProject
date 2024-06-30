<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $fillable=[
        'user_id',
        'shipping_id',
        'adress',
        'country',
        'city',
        'status',
        'sub_total',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItem()
    {
        return $this->hasOne(OrderItem::class);
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }
}
