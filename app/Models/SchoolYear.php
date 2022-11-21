<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;

    protected $fillable =[
        'school_id',
        'year',
        'start_on',
        'end_on',
        'this_year',
    ];
    protected $dates = [
        'start_on',
        'end_on',
    ];
    
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
