<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Define the table name explicitly if needed
    protected $table = 'students';

    // Whitelist the form fields for database insertion
    protected $fillable = [
        'name',
        'student_id',
        'course',
        'year',
        'status',
    ];
}