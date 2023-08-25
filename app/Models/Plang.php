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


    public function plangsViaFrameworkCompany() // plangs via the framework_company
    {
        return $this->belongsToMany(Plang::class, 'framework_company')->withPivot(['draft_rating', 'status', 'rating']);
    }
}
