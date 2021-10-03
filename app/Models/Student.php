<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = "students";
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'username',
        'img',
        'birthday',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'country',
        'role',
        'status'
    ];
}
