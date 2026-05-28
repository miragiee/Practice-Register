<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Role;
use App\Models\University;
use App\Models\Direction;
use App\Models\Student;

class StudentQualitiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_store_json_qualities()
    {
        $adminRole = Role::create(['name' => 'Администратор']);
        $adminUser = User::factory()->create(['role_id' => $adminRole->id]);

        $university = University::create([
            'user_id' => $adminUser->id,
            'name' => 'Test University',
            'inn' => '2222222222',
            'contact_person' => 'Test Person',
            'position' => 'Director',
            'phone' => '987654321',
        ]);

        $direction = Direction::create([
            'name' => 'Data Science',
            'description' => 'Data science direction',
        ]);

        $this->actingAs($adminUser);

        $response = $this->post('/students', [
            'full_name' => 'Иванов Иван',
            'university_id' => $university->id,
            'direction_id' => $direction->id,
            'course' => 3,
            'email' => 'student@example.test',
            'qualities' => '["PHP","SQL"]',
        ]);

        $response->assertSessionHas('success');

        $student = Student::where('email', 'student@example.test')->firstOrFail();
        $this->assertSame(['PHP', 'SQL'], $student->qualities);
    }
}
