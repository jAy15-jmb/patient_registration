<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'hospital_number',
        'last_name',
        'first_name',
        'middle_name',
        'suffix',
        'date_of_birth',
        'gender',
        'civil_status',
        'address',
    ];
}
