<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "name",
        "inn",
        "contact_person",
        "position",
        "phone",
        "description",
    ];

    /*
    |--------------------------------------------------------------------------
    | Связи
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function internships()
    {
        return $this->hasMany(Internship::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
