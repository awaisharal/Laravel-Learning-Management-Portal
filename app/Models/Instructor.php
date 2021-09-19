<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    protected $table = "instructors";
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'students',
        'courses',
        'role',
        'birthday',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'country',
        'status'
    ];
}
