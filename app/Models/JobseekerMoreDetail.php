<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobseekerMoreDetail extends Model
{
    use HasFactory;

    public function jobseeker(){
        return $this->belongsTo(User::class,'jobseeker_id','id');
    }

    
}
