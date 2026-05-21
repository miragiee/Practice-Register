<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",

        "name",

        "description",

        "contact_info",

        "inn",

        "website",
    ];

    /*
    |--------------------------------------------------------------------------
    | Связь с user
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Контракты
    |--------------------------------------------------------------------------
    */

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
