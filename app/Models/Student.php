<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded=[];
    // Define the relationship with the Mark model
    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }


    //for finding missing,duplicate,extra page
    //this is for all page/question assign for student
    public function evaluatedPageDesignIds()
    {
        return $this->evaluations->pluck('page_design_id')->toArray();
    }

    //unique page/question
    public function uniquePageDesignCount()
    {
        return count(array_unique($this->evaluatedPageDesignIds()));
    }

    //find missing questions(suppose for civil:question(page_deisgn_id) is : 1-15 but having 1-14 that means 15 question is missing)
    public function missingPageDesigns(array $totalPageDesigns)
    {
        return array_diff($totalPageDesigns, array_unique($this->evaluatedPageDesignIds()));
    }

    //find extra page: suppose:student have question 1-20 that means 16-20 total 5 question is missing
    public function extraPageDesigns(array $totalPageDesigns)
    {
        return array_diff(array_unique($this->evaluatedPageDesignIds()), $totalPageDesigns);
    }

    //if student have question:1 twise that means duplicate question have
    public function duplicatePageDesigns()
    {
        return array_keys(array_filter(array_count_values($this->evaluatedPageDesignIds()), function ($count) {
            return $count > 1;
        }));
    }

    public function hasIncompletePages(array $totalPageDesigns)
    {
        return count($this->missingPageDesigns($totalPageDesigns)) > 0 || $this->uniquePageDesignCount() < 15;
    }
}
