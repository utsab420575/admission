<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageDesign extends Model
{
    protected $guarded=[];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function partType()
    {
        return $this->belongsTo(PartType::class, 'part_id');
    }

    public function examiner()
    {
        return $this->hasOne(Examiner::class);
    }
}
