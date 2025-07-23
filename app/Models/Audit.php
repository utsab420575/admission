<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    //

    public function evaluation() {
        return $this->belongsTo(Evaluation::class);
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
