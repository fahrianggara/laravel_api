<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public function scores()
    {
        return $this->hasMany('App\Models\Score', 'student_id');
    }

    // public function score()
    // {
    //     // return $this->belongsToMany();
    // }
}
