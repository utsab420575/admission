<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examiner extends Model
{
    //
    protected $guarded=[];
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function pageDesign() {
        return $this->belongsTo(PageDesign::class);
    }
}
