<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'direction_id',
        'start_date',
        'end_date',
        'capacity',
        'qualities',
        'description',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'qualities' => 'array',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }
}
