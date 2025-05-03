<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantJob extends Model
{
    use HasFactory;
    protected $table = 'applicatnt_jobs';
    public function applicant(){
        return $this->belongsTo(User::class,'applicant_id','id');
    }

    public function occupation(){
        return $this->belongsTo(Occupation::class,'job_id','id');
    }
}
