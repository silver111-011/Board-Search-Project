<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobseekerCategory extends Model
{
    use HasFactory;
    protected $table = 'jobseeker_occupation_categories';

    protected $fillable = [
       
        'jobseeker_id',
        'category_id'
    ];
}