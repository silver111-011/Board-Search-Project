<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerCharge extends Model
{
    use HasFactory;
    public function employer(){
        return $this->belongsTo(User::class, 'employer_id','id');
    }
}
