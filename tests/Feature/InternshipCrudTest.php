<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Role;
use App\Models\University;
use App\Models\Direction;
use App\Models\Internship;

class InternshipCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_internship_index_returns_json_and_stores_qualities()
    {
        $role = Role::create(['name' => 'Университет']);
        $universityUser = User::factory()->create(['role_id' => $role->id]);

        $university = University::create([
            'user_id' => $universityUser->id,
            'name' => 'Test University',
            'inn' => '1111111111',
            'contact_person' => 'Test Person',
            'position' => 'Director',
            'phone' => '123456789',
        ]);

        $direction = Direction::create([
            'name' => 'Backend',
            'description' => 'Backend development',
        ]);

        $response = $this->post('/internships/store', [
            'university_id' => $university->id,
            'direction_id' => $direction->id,
            'start_date' => '2026-06-01',
            'end_date' => '2026-06-30',
            'capacity' => 5,
            'qualities' => '["PHP","Laravel"]',
            'description' => 'Стажировка по PHP',
        ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('internships', [
            'university_id' => $university->id,
            'direction_id' => $direction->id,
            'capacity' => 5,
            'description' => 'Стажировка по PHP',
        ]);

        $internship = Internship::first();
        $this->assertSame(['PHP', 'Laravel'], $internship->qualities);

        $jsonResponse = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/internships');

        $jsonResponse->assertOk();
        $jsonResponse->assertJsonFragment([
            'description' => 'Стажировка по PHP',
        ]);
    }
}
