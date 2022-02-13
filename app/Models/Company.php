<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function getRouteKeyName() {
        return "slug";
    }

    //Relacción uno a uno inversa
    public function user() {
        return $this->belongsTo(User::class);
    }

    //Relación muchos a muchos
    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function allChildrenCategories() {
        return $this->categories()->with('allChildrenCategories');
    }

    public function workSchedules() {
        return $this->belongsToMany(WorkShedule::class)
                    ->orderBy('day','ASC');
    }

    //Relación uno a muchos
    public function locations() {
        return $this->hasMany(Location::class);
    }

    public function socialNetworks() {
        return $this->hasMany(SocialNetwork::class);
    }

    public function phones() {
        return $this->hasMany(Phone::class);
    }

    //Relación polimorfica uno a muchos
    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }
}
