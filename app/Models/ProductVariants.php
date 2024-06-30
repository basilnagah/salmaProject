<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariants extends Model
{
    use HasFactory;

    protected $fillable = [
        'color_id',
        'size_id',
        'product_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(color::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function image()
    {
        return $this->hasMany(Medias::class);
    }

    public function orderItem()
    {
        return $this->hasMany(orderItem::class,'product_variant_id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderedQuantity()
    {
        return $this->orderItem()->sum('quantity');
    }

    public function availableQuantity()
    {
        return $this->quantity - $this->orderedQuantity();
    }

    public function isSoldOut()
    {
        return $this->availableQuantity() <= 0;
    }


}
