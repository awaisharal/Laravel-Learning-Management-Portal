<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $table = "quizes";
    protected $fillable = ['title', 'course_id','section_id','instructor_id','status'];
}
