<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    protected $fillable=[
        'faculty'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class,'faculty_id');
    } 
}
