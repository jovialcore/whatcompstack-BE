<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FeFramework extends Model
{
    use HasFactory;



    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'fe_framework_company')->withPivot(['draft_rating', 'is_draft', 'is_published', 'rating']);
    }

    
}
