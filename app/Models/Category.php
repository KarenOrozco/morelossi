<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    private $descendants = [];

    protected $fillable = ['name','slug','parent_id'];

    public function getRouteKeyName() {
        return "slug";
    }

    //Relación muchos a muchos
    public function companies() {
        return $this->belongsToMany(Company::class);
    }

    public function parent() {
        return $this->belongsTo(Category::class);
    }

    public function parentRoot() {
        return $this->belongsTo(Category::class);
    }

    public function categoriesRoot() {
        return $this->hasMany(Category::class, 'parent_root_id');
    }

    public function categories() {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function allChildrenCategories() {
        return $this->hasMany(Category::class, 'parent_id')->with('categories');

        // return $this->categories()->with('allChildrenCategories');
    }


    //----------------------------------------
    public function hasChildren(){
        if(count($this->categories)){
            return true;
        }

        return false;
    }

    public function findDescendants(Category $category){

        $this->descendants[]=$category->id;
        //array_push($this->descendants, $category->id);

        if($category->hasChildren()){
            foreach($category->categories as $child){
                $this->findDescendants($child);
            }
        }
    }

    public function getDescendants(Category $category){
        $this->findDescendants($category);
        return $this->descendants;
    }

    //Relación polimorfica uno a muchos
    //Relación polimorfica uno a uno
    // public function image() {
    //     return $this->morphOne(Image::class, 'imageable');
    // }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }
}
