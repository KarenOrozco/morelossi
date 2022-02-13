<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //Relación uno a muchos inversa
    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }
}
