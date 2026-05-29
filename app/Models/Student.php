<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        "full_name",
        "university_id",
        "direction_id",
        "course",
        "email",
        "qualities",
    ];

    public function getVerifiedAttribute(): bool
    {
        $user = User::where('email', $this->email)->first();

        if ($user && $user->email_verified_at) {
            return true;
        }

        return !User::where('email', $this->email)->exists();
    }

    public function getSkillsAttribute(): array
    {
        $qualities = $this->qualities;

        if (is_array($qualities)) {
            return array_values(array_filter($qualities, fn ($item) => $item !== null && $item !== ''));
        }

        $decoded = json_decode($qualities, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return array_values(array_filter($decoded, fn ($item) => $item !== null && $item !== ''));
        }

        return [];
    }

    public function getRoleAttribute(): string
    {
        return $this->attributes['role'] ?? 'Студент';
    }

    protected $casts = [
        'qualities' => 'array',
    ];

    public function studentInternships()
    {
        return $this->hasMany(StudentInternship::class);
    }


    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
