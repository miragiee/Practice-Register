<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        "full_name",
        "university_id",
        "direction_id",
        "course",
        "email",
        "qualities",
    ];

    protected $casts = [
        'qualities' => 'array',
    ];

    public function studentInternships()
    {
        return $this->hasMany(StudentInternship::class);
    }


    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
