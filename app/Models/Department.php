<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded=[];

    public function pageDesigns()
    {
        return $this->hasMany(PageDesign::class);
    }
    public function students() {
        return $this->hasMany(Student::class);
    }

    // Define the relationship with the Mark model
    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
