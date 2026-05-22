<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Database\Factories\UserFactory;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

use App\Models\Role;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = ["name", "email", "password", "role_id"];

    protected $hidden = ["password", "remember_token"];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",

            "password" => "hashed",
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | ROLE
    |--------------------------------------------------------------------------
    */

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /*
    |--------------------------------------------------------------------------
    | STUDENT
    |--------------------------------------------------------------------------
    */

    public function student()
    {
        return $this->hasOne(Student::class, "email", "email");
    }

    /*
    |--------------------------------------------------------------------------
    | COMPANY
    |--------------------------------------------------------------------------
    */

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    /*
    |--------------------------------------------------------------------------
    | UNIVERSITY
    |--------------------------------------------------------------------------
    */

    public function university()
    {
        return $this->hasOne(University::class);
    }
}
