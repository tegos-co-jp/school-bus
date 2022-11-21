<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlManager extends Model
{
    use HasFactory;

    protected $fillable =[
        'school_group_id',
        'name',
        'email',
        'authority_flag',
        'password',
    ];
    
     public function school_group()
     {
         return $this->belongsTo(SchoolGroup::class);
     }
}
