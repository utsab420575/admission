<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded=[];
    public function pageDesigns()
    {
        return $this->hasMany(PageDesign::class);
    }
}
