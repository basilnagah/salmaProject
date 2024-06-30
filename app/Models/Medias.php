<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medias extends Model
{
    use HasFactory;

    protected $fillable=[
        "mediaable_type",
        "mediaable_id",
        "filename",
        "filetype",
        "type",
        "Second_type",
        "createBy_id",
        "createBy_type",
        "updateBy_id",
        "updateBy_type",
        "color_id",
    ];

    public function mediaable()
    {
        return $this->morphTo();
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

}
