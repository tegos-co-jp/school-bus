<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable =[
        'school_group_id',
        'code',
        'name',
        'short_name',
        'zip_code',
        'address',
        'reception_finish_time',
        'phone_number',
    ];
    
    public function school_group()
    {
        return $this->belongsTo(SchoolGroup::class);
    }
}
