<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class student extends Model
{
    
    use HasFactory;


    protected $table ='students';
    
    protected $fillable = [
        'nic',
        'fname',
        'lname',
        'dob',
        'gender',
        'phone_no',
        'address',
        'email',
        'degree_id',
        'degree_name',
        'batch_no',
    ];

    protected $casts = [
        'student_id' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($student) {
        $latestStudent = DB::table('students')->latest('id')->first();
        $latestId = $latestStudent ? $latestStudent->id + 1 : 1;
        $student->student_id = 'Student_' . str_pad($latestId, 2, '0', STR_PAD_LEFT);

        });
    }    
}
