<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Direction;
use App\Models\Student;
use App\Models\University;
use App\Models\User;
use App\Models\Role;

class StudentApiTest extends TestCase
{
    use RefreshDatabase;

    private function createUniversity(): University
    {
        $user = User::factory()->create([
            'role_id' => Role::create(['name' => 'Университет'])->id,
        ]);

        return University::create([
            'user_id' => $user->id,
            'name' => 'Университет',
            'inn' => '1234567890',
            'contact_person' => 'Контакт',
            'position' => 'Декан',
            'phone' => '123456789',
        ]);
    }

    public function test_api_students_returns_json_list()
    {
        $direction = Direction::create([
            'name' => 'Тестовое направление',
            'description' => 'Описание направления',
        ]);

        $university = $this->createUniversity();

        Student::create([
            'full_name' => 'Иван Иванов',
            'university_id' => $university->id,
            'direction_id' => $direction->id,
            'course' => 2,
            'email' => 'student-api@example.test',
            'qualities' => ['PHP'],
        ]);

        $response = $this->getJson('/api/students');

        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJsonFragment(['email' => 'student-api@example.test']);
    }

    public function test_student_show_page_is_accessible()
    {
        $direction = Direction::create([
            'name' => 'Направление',
            'description' => 'Описание',
        ]);

        $university = $this->createUniversity();

        $student = Student::create([
            'full_name' => 'Иван Иванов',
            'university_id' => $university->id,
            'direction_id' => $direction->id,
            'course' => 2,
            'email' => 'student-show@example.test',
            'qualities' => ['PHP'],
        ]);

        $adminUser = User::factory()->create([
            'role_id' => Role::create(['name' => 'Администратор'])->id,
        ]);

        $response = $this->actingAs($adminUser)
            ->get('/students/' . $student->id);

        $response->assertStatus(200);
        $response->assertSee('Иван Иванов');
    }
}
