<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Selected extends Model
{
    //

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }
}
