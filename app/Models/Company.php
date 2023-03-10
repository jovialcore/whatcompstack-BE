<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'name',
        'stack',
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
}
