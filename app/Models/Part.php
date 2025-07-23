<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    //

    public function pageDesign() {
        return $this->belongsTo(PageDesign::class);
    }
}
