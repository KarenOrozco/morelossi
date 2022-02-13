<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkShedule extends Model
{
    use HasFactory;

    protected $fillable = ['start_time','finish_time','day'];

    //Relación muchos a muchos
    public function companies() {
        return $this->belongsToMany(Company::class);
    }
}
