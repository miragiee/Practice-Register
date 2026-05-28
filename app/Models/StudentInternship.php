<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInternship extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'company_id',
        'internship_id',
        'contract_id',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function internship()
    {
        return $this->belongsTo(Internship::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
