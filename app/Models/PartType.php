<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartType extends Model
{
    protected $guarded=[];
    public function pageDesigns()
    {
        return $this->hasMany(PageDesign::class, 'part_id');
    }
}
