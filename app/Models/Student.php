<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded=[];
    // Define the relationship with the Mark model
    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
    public function department() {
        return $this->belongsTo(Department::class);
    }
}
