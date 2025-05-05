<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_id',
        'category_id',
    ];

    public function job(){
        return $this->belongsTo(Occupation::class ,'job_id','id');
    }
    public function category(){
        return $this->belongsTo(Category::class ,'category_id','id');
    }
}
