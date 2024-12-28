<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class visitlecturer extends Model
{
    use HasFactory;
    protected $table ='users';

    protected $primarykey='id';

    protected $fillable = [
        // 'visitlecturer_id',
        // 'password',
        'name',
        'email',
        'phone',
    ];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($visitlecturer) {
            $latestLecturer = DB::table('visitlecturers')->latest('id')->first();
            $latestId = $latestLecturer ? $latestLecturer->id + 1 : 1;
            $visitlecturer->lecturer_id = 'Lecturer_' . str_pad($latestId, 2, '0', STR_PAD_LEFT);

            $latestPassword = DB::table('visitlecturers')->latest('id')->first();
            $latestPass = $latestPassword ? $latestPassword->id + 1 : 1;
            $visitlecturer->password = 'Bci@00' . str_pad($latestPass, 2, '0', STR_PAD_LEFT);
        });
    }
    
}