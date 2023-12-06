<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stack_be',
        'stack_fe',
        'database_driver',
        'devops',
        'ceo',
        'ceo_contact',
        'cto',
        'cto_contact',
        'hr',
        'hr_contact',
        'testimonials',
        'salary_range',
        'logo',
        'about',
        'url',
    ];

    protected $casts = [

        'stack_be' => 'array',
        'stack_fe' => 'array',
        'devops' => 'array',
        'database_driver' => 'array'

    ];


    public function plangs() // plangs via company
    {
        $this->wasRecentlyCreated;
        return $this->belongsToMany(Plang::class, 'plang_company')->withPivot(['draft_rating', 'is_draft', 'is_published',  'rating']);
    }

    public function frameworks() // frameworks via company // this is for be right
    {
        return $this->belongsToMany(Framework::class, 'framework_company')->withPivot(['draft_rating', 'is_draft', 'is_published', 'rating']);
    }

    public function feFrameworks(): BelongsToMany
    {
        return $this->belongsToMany(FeFramework::class, 'fe_framework_company')->withPivot(['draft_rating', 'is_draft', 'is_published', 'rating']);
    }

    public function scopeFetchAllClientDetails($query)
    {
        return $query->withWhereHas('plangs', function ($query) {
            $query->where('is_published', 1);
        })->with('frameworks', function ($query) {
            $query->where('is_published', 1);
        })->with('feFrameworks', function ($query) {
            $query->where('is_published', 1);
        });
    }
}
