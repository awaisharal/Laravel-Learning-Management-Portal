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
        'street_address',
        'suburb',
        'postcode',
        'state',
        'country',
        'fb_link',
        'linkedin_link',
        'youtube_link',
        'twitter_link',
        'github_link',
        'status'
    ];
}
