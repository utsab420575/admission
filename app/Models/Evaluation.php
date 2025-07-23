<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    //

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }

    public function pageDesign() {
        return $this->belongsTo(PageDesign::class);
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
    
}
