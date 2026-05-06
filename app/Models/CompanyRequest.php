<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'direction_id',
        'internship_id',
        'required_count',
        'requirements_text',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
