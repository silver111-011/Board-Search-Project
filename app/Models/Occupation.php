<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    use HasFactory;
    protected $table = 'jobs';
    protected $fillable = [
        'title',
        'description',
        'salary',
        'employer_id',
        'is_closed',
        'is_verified'
    ];
    public function employer(){
        return $this->belongsTo(User::class,'employer_id','id');
    }
    public function applicants(){
        return $this->hasMany(ApplicantJob::class,'applicant_id','id');
    } 
    public function jobAddress(){
        return $this->hasOne(JobLocation::class,'job_id','id');
    }

    public function jobCategories(){
        return $this->hasMany(JobCategory::class,'job_id','id');
    }

    
}
