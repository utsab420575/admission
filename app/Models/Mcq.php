<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mcq extends Model
{
    //

    protected $casts = [
        'ans_raw' => 'array',
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function mcqSet() {
        return $this->belongsTo(McqSet::class);
    }
}
