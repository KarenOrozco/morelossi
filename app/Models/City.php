<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    private $descendants = [];

    public function getRouteKeyName() {
        return "slug";
    }
    
    //Relación polimorfica uno a muchos
    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }

    //Relación uno a muchos
    public function locations() {
        return $this->belongsToMany(Location::class);
    }

    public function parent() {
        return $this->belongsTo(City::class);
    }

    public function cities() {
        return $this->hasMany(City::class, 'parent_id');
    }

    public function allChildrenCategories() {
        return $this->hasMany(City::class, 'parent_id')->with('cities');
    }

    //----------------------------------------
    public function hasChildren(){
        if(count($this->cities)){
            return true;
        }

        return false;
    }

    public function findDescendants(City $city){

        $this->descendants[]=$city->id;
        //array_push($this->descendants, $category->id);

        if($city->hasChildren()){
            foreach($city->cities as $child){
                $this->findDescendants($child);
            }
        }
    }

    public function getDescendants(City $city){
        $this->findDescendants($city);
        return $this->descendants;
    }
}
