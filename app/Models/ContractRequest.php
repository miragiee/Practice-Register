<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'university_id',
        'company_accept',
        'university_accept',
    ];

    protected $casts = [
        'company_accept'    => 'boolean',
        'university_accept' => 'boolean',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}