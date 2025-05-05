<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobLocation extends Model
{
    use HasFactory;
    protected $table = 'job_address';
    protected $fillable = [
        'country',
        'city',
        'district',
        'street',
        'job_id',
        'is_closed',
    ];
}
