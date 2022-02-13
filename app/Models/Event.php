<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName() {
        return "slug";
    }
    
    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }
}
