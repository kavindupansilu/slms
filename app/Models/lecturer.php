<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class lecturer extends Model
{
    use HasFactory;
    protected $table ='users';

    protected $primarykey='id';

    protected $fillable = [
        // 'lecturer_id',
        // 'password',
        'name',
        'email',
        'phone',
    ];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($lecturer) {
            $latestLecturer = DB::table('lecturers')->latest('id')->first();
            $latestId = $latestLecturer ? $latestLecturer->id + 1 : 1;
            $lecturer->lecturer_id = 'Lecturer_' . str_pad($latestId, 2, '0', STR_PAD_LEFT);

            $latestPassword = DB::table('lecturers')->latest('id')->first();
            $latestPass = $latestPassword ? $latestPassword->id + 1 : 1;
            $lecturer->password = 'Bci@00' . str_pad($latestPass, 2, '0', STR_PAD_LEFT);
        });
    }
    
}