<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

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
    ];

    protected $casts = [

        'stack_be' => 'array',
        'stack_fe' => 'array',
        'devops' => 'array',
        'database_driver' => 'array'

    ];


    public function plangs()
    {
        return $this->belongsToMany(Plang::class, 'plang_company')->withPivot('rating');
    }
}
