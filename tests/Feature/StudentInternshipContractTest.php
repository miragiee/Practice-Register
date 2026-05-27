<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Role;
use App\Models\User;
use App\Models\University;
use App\Models\Company;
use App\Models\Internship;
use App\Models\Student;
use App\Models\Contract;
use App\Models\Direction;

class StudentInternshipContractTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_requires_active_contract()
    {
        // Создаём администратора для прохождения middleware
        $role = Role::create(['name' => 'Администратор']);
        $user = User::factory()->create(['role_id' => $role->id]);

        $this->actingAs($user);

        $roleUniversity = Role::create(['name' => 'Университет']);
        $roleCompany = Role::create(['name' => 'Компания']);

        $uniUser = User::factory()->create(['role_id' => $roleUniversity->id]);
        $companyUser = User::factory()->create(['role_id' => $roleCompany->id]);

        $university = University::create(['user_id' => $uniUser->id, 'name' => 'U', 'inn' => '1', 'contact_person' => 'X', 'position' => 'P', 'phone' => '111']);

        $company = Company::create([
            'user_id' => $companyUser->id,
            'name' => 'C',
            'description' => 'desc',
            'contact_info' => 'contact',
            'inn' => '123',
            'website' => '',
        ]);

        $direction = Direction::create(['name' => 'Test direction', 'description' => 'desc']);

        $internship = Internship::create([
            'university_id' => $university->id,
            'start_date' => now()->addDays(1)->toDateString(),
            'end_date' => now()->addDays(10)->toDateString(),
            'description' => 'desc',
            'capacity' => 5,
        ]);

        $student = Student::create([
            'full_name' => 'Ivan',
            'university_id' => $university->id,
            'direction_id' => $direction->id,
            'course' => 2,
            'email' => 'ivan@example.test',
        ]);

        // Без контракта — ожидаем ошибку в сессии
        $response = $this->post('/student-internships', [
            'student_id' => $student->id,
            'company_id' => $company->id,
            'internship_id' => $internship->id,
            'status' => 'assigned',
        ]);

        $response->assertSessionHas('error');

        // Добавим контракт, покрывающий даты
        Contract::create([
            'university_id' => $university->id,
            'company_id' => $company->id,
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDays(20)->toDateString(),
            'status' => 'active',
        ]);

        $response = $this->post('/student-internships', [
            'student_id' => $student->id,
            'company_id' => $company->id,
            'internship_id' => $internship->id,
            'status' => 'assigned',
        ]);

        $response->assertSessionHas('success');
    }
}
