<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'desc',
        'quantity',
        'price',
        'salePrice',
        'sale',
        'category_id',
        'best_selling'
    ];

    public function category()
    {
         return $this->belongsTo(Category::class, 'category_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }
    
    public function image(){
        return $this->morphOne(Medias::class, 'mediaable');
    }

    public function productVariants()
    {
        return $this->hasMany(ProductVariants::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }

}
