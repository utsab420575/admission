<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class McqQuestion extends Model
{
    //

    public function mcqSet() {
        return $this->belongsTo(McqSet::class);
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }
}
