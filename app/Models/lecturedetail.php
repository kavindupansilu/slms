<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lecturedetail extends Model
{
    use HasFactory;

    protected $table ='lecturedetails';


    protected $fillable = [
        'lecturer_name',
        'degree',
        'course_name',
        'batch',
    ];

    }
