<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class course extends Model
{
    use HasFactory;
    protected $table ='courses';

    protected $primarykey='ccode';
    protected $keyType = 'string';

    protected $fillable = [
        'ccode',
        'cname',
        'credit',
        'year',
        'semster',
        'degree_name',
        'fname',
        'lname',
        'degree_id',
        'user_id',
        
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            // Get the latest course ID
            $latestCourse = DB::table('courses')->latest('id')->first();
            $latestId = $latestCourse ? $latestCourse->id + 1 : 1;
            $degree = DB::table('degrees')->where('id', $course->degree_id)->first(); // Get the degree title
            $degreeTitle = $degree ? $degree->title : 'Unknown';
            $course->ccode = 'BS' . $degreeTitle . '_' . str_pad($latestId, 2, '0', STR_PAD_LEFT); // ccode
        });
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'ccode', 'ccode');
    }

}
