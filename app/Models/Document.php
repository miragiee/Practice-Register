<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_internship_id',
        'file_path',
        'type',
    ];

    public function studentInternship()
    {
        return $this->belongsTo(StudentInternship::class);
    }
}
