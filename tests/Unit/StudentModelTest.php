<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Direction;
use App\Models\Student;
use App\Models\University;
use App\Models\User;
use App\Models\Role;

class StudentModelTest extends TestCase
{
    use RefreshDatabase;

    private function createUniversity(): University
    {
        $user = User::factory()->create([
            'role_id' => Role::create(['name' => 'Университет'])->id,
        ]);

        return University::create([
            'user_id' => $user->id,
            'name' => 'Тестовый вуз',
            'inn' => '1234567890',
            'contact_person' => 'Контакт',
            'position' => 'Декан',
            'phone' => '123456789',
        ]);
    }

    private function createDirection(): Direction
    {
        return Direction::create([
            'name' => 'Тестовое направление',
            'description' => 'Описание направления',
        ]);
    }

    public function test_skills_attribute_parses_json_string()
    {
        $student = Student::create([
            'full_name' => 'Иван Иванов',
            'university_id' => $this->createUniversity()->id,
            'direction_id' => $this->createDirection()->id,
            'course' => 1,
            'email' => 'ivan@example.test',
            'qualities' => '["PHP", "SQL"]',
        ]);

        $this->assertSame(['PHP', 'SQL'], $student->skills);
    }

    public function test_skills_attribute_returns_array_for_array_input()
    {
        $student = Student::create([
            'full_name' => 'Иван Иванов',
            'university_id' => $this->createUniversity()->id,
            'direction_id' => $this->createDirection()->id,
            'course' => 1,
            'email' => 'ivan2@example.test',
            'qualities' => ['PHP', 'SQL', null, ''],
        ]);

        $this->assertSame(['PHP', 'SQL'], $student->skills);
    }

    public function test_verified_attribute_is_true_when_no_user_exists()
    {
        $student = Student::create([
            'full_name' => 'Иван Иванов',
            'university_id' => $this->createUniversity()->id,
            'direction_id' => $this->createDirection()->id,
            'course' => 1,
            'email' => 'no-user@example.test',
            'qualities' => [],
        ]);

        $this->assertTrue($student->verified);
    }

    public function test_verified_attribute_is_false_when_user_exists_unverified()
    {
        $studentRoleId = Role::create(['name' => 'Студент'])->id;

        User::factory()->create([
            'email' => 'exists@example.test',
            'email_verified_at' => null,
            'role_id' => $studentRoleId,
        ]);

        $student = Student::create([
            'full_name' => 'Иван Иванов',
            'university_id' => $this->createUniversity()->id,
            'direction_id' => $this->createDirection()->id,
            'course' => 1,
            'email' => 'exists@example.test',
            'qualities' => [],
        ]);

        $this->assertFalse($student->verified);
    }

    public function test_role_attribute_defaults_to_student()
    {
        $student = Student::create([
            'full_name' => 'Иван Иванов',
            'university_id' => $this->createUniversity()->id,
            'direction_id' => $this->createDirection()->id,
            'course' => 1,
            'email' => 'role@example.test',
            'qualities' => [],
        ]);

        $this->assertSame('Студент', $student->role);
    }
}
