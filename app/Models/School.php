<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable =[
        'code',
        'name',
        'zip_code',
        'address',
        'representative_name',
        'phone_number',
        'email',
    ];
}
