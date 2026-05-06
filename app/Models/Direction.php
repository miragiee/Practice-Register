<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function companyRequests()
    {
        return $this->hasMany(CompanyRequest::class);
    }
}
