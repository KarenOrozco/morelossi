<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    use HasFactory;

    protected $fillable = ['url','type','company_id'];

    //Relación uno a muchos inversa
    public function company() {
        return $this->belongsTo(Company::class);
    }
}
