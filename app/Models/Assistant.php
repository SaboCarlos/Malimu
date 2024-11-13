<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'age',
        'gender',
        'experience_summary',
        'availability',
        'contacts',
        'academic_qualifications',
        'skills',
        'area_of_experience',
        'status',
        'profile',
        'idiomas',
        'lat',
        'lng',
        'province',
        'district'
    ];

    public function user()
    {
       return $this->belongsTo(User::class, 'user_id','id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'assistant_id');
    }
}
