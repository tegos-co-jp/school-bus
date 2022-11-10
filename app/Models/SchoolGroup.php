<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolGroup extends Model
{
    use HasFactory;

    protected $fillable =[
        'code',
        'name',
        'location',
        'alert_time',
    ];

    public function schools()
    {
        return $this->hasMany(School::class);
    }

}
