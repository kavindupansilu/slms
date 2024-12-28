<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class degree extends Model
{
    use HasFactory;
    protected $table ='degrees';

    protected $fillable = [
        'degree_id',
        'name',
        'title',
        'duration',
        
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($degree) {
        $latestDegree = DB::table('degrees')->latest('id')->first();
        $latestId = $latestDegree ? $latestDegree->id + 1 : 1;
        $degree->degree_id = $degree->title . '_'  . str_pad($latestId, 2, '0', STR_PAD_LEFT);

        });
    }
}

