<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $guarded=[];

    public function student() {
        return $this->belongsTo(Student::class);
    }
    // Define the relationship with the Department model
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
