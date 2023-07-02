<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plang extends Model
{
    use HasFactory;



    function frameworks()
    {
        return $this->hasMany(Framework::class, 'plang_id');
    }

    function companies()
    {
        return $this->belongsToMany(Company::class, 'plang_company')->withPivot('rating');
    }
}
