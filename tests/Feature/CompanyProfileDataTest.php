<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\CompanyRequest;
use App\Models\Direction;
use App\Models\Internship;
use App\Models\Reservation;
use App\Models\Role;
use App\Models\Student;
use App\Models\University;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyProfileDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_profile_renders_real_vacancies_and_reservations()
    {
        $roleCompany = Role::create(['name' => 'Компания']);
        $roleUni = Role::create(['name' => 'Университет']);

        $companyUser = User::factory()->create(['role_id' => $roleCompany->id]);
        $uniUser = User::factory()->create(['role_id' => $roleUni->id]);
        $university = University::create([
            'user_id' => $uniUser->id,
            'name' => 'Test University',
            'inn' => '9876543210',
            'contact_person' => 'Teacher',
            'position' => 'Dean',
            'phone' => '111222333',
        ]);

        $company = Company::create([
            'user_id' => $companyUser->id,
            'name' => 'Acme Corp',
            'description' => 'IT company',
            'contact_info' => 'contact',
            'inn' => '1234567890',
            'website' => 'https://example.test',
        ]);

        $direction = Direction::create(['name' => 'Backend', 'description' => 'Backend']);
        $internship = Internship::create([
            'university_id' => $university->id,
            'direction_id' => $direction->id,
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDays(10)->toDateString(),
            'capacity' => 2,
            'description' => 'Backend internship',
            'qualities' => ['PHP', 'Laravel'],
        ]);

        $student = Student::create([
            'full_name' => 'Ivan Petrov',
            'university_id' => $university->id,
            'direction_id' => $direction->id,
            'course' => 3,
            'email' => 'student@example.test',
            'qualities' => ['PHP'],
        ]);

        CompanyRequest::create([
            'company_id' => $company->id,
            'direction_id' => $direction->id,
            'internship_id' => $internship->id,
            'required_count' => 2,
            'requirements_text' => 'PHP, Laravel, командная работа',
        ]);

        Reservation::create([
            'company_id' => $company->id,
            'student_id' => $student->id,
            'internship_id' => $internship->id,
            'status' => 'pending',
        ]);

        $this->actingAs($companyUser);

        $response = $this->get('/profile/company');

        $response->assertOk();
        $response->assertSee('Backend internship');
        $response->assertSee('Ivan Petrov');
        $response->assertSee('Бронирования');
        $response->assertSee('Отменить');
    }
}
