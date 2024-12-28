<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'title',
        'nic',
        'fname',
        'lname',
        'email',
        'phone',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'user_id' => 'string',
        'password' => 'hashed',
    ];

    protected $plainPassword; // temporary holds the password without hash version

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        $this->password = bcrypt($plainPassword); // make plain password to hash version
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) { // create User Id
            $latestAdmin = DB::table('users')->latest('id')->first();
            $latestId = $latestAdmin ? $latestAdmin->id + 1 : 1;
            $user->user_id = $user->role . '_' . str_pad($latestId, 2, '0', STR_PAD_LEFT);

            $latestPassword = DB::table('users')->latest('id')->first(); // Create User password
            $latestPass = $latestPassword ? $latestPassword->id + 1 : 1;
            $plainPassword = $user->role . 'Bci@00' . str_pad($latestPass, 2, '0', STR_PAD_LEFT);
            $user->setPlainPassword($plainPassword);
        });
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'user_id', 'user_id');
    }
}
