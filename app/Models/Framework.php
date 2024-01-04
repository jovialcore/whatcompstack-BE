<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Framework extends Model
{
    use HasFactory;

    function companies()
    {
        return $this->belongsToMany(Company::class, 'framework_company')->withPivot(['draft_rating', 'is_draft', 'is_published', 'rating']);
    }
}
