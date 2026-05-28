<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyRequest extends Model
{
    use HasFactory;

    protected $table = "company_requests";

    protected $fillable = [
        "company_id",
        "direction_id",
        "internship_id",
        "required_count",
        "requirements_text",
    ];

    protected $casts = [
        "company_id" => "integer",
        "direction_id" => "integer",
        "internship_id" => "integer",
        "required_count" => "integer",
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }

    public function internship()
    {
        return $this->belongsTo(Internship::class);
    }

    public function getRequirementsTagsAttribute(): array
    {
        $text = (string) $this->requirements_text;

        $parts = preg_split('/\r\n|\r|\n|,/', $text);

        $tags = array_filter(array_map(function ($part) {
            $tag = trim($part);
            return $tag === '' ? null : $tag;
        }, $parts ?? []));

        return array_values($tags);
    }
}
