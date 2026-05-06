<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'company_id',
        'start_date',
        'end_date',
        'status',
    ];


    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

}
