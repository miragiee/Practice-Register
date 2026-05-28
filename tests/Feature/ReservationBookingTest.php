<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use App\Models\Role;
use App\Models\User;
use App\Models\University;
use App\Models\Company;
use App\Models\Internship;
use App\Models\Student;
use App\Models\Contract;

class ReservationBookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_cannot_book_without_contract_and_can_with_contract()
    {
        $roleCompany = Role::create(['name' => 'Компания']);
        $roleUni = Role::create(['name' => 'Университет']);

        $companyUser = User::factory()->create(['role_id' => $roleCompany->id]);
        $uniUser = User::factory()->create(['role_id' => $roleUni->id]);

        $company = Company::create(['user_id' => $companyUser->id, 'name' => 'C', 'description' => 'd', 'contact_info' => 'c', 'inn' => '123', 'website' => '']);
        $university = University::create(['user_id' => $uniUser->id, 'name' => 'U', 'inn' => '1', 'contact_person' => 'X', 'position' => 'P', 'phone' => '111']);

        $direction = \App\Models\Direction::create(['name' => 'D', 'description' => 'd']);

        $internship = Internship::create(['university_id' => $university->id, 'start_date' => now()->toDateString(), 'end_date' => now()->addDays(5)->toDateString(), 'description' => 'd', 'capacity' => 2]);

        $student = Student::create(['full_name' => 'Ivan', 'university_id' => $university->id, 'direction_id' => $direction->id, 'course' => 1, 'email' => 'a@b.test']);

        // company tries to book without contract
        $this->actingAs($companyUser);

        Notification::fake();

        $response = $this->post('/reservations/book', [
            'student_id' => $student->id,
            'internship_id' => $internship->id,
            'status' => 'pending',
        ]);
        $response->assertSessionHas('error');

        $response->assertSessionHas('error');

        // create contract
        Contract::create(['university_id' => $university->id, 'company_id' => $company->id, 'start_date' => now()->subDays(1)->toDateString(), 'end_date' => now()->addDays(10)->toDateString(), 'status' => 'active']);

        $response = $this->post('/reservations/book', [
            'student_id' => $student->id,
            'internship_id' => $internship->id,
            'status' => 'pending',
        ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('student_internships', [
            'student_id' => $student->id,
            'company_id' => $company->id,
            'internship_id' => $internship->id,
            'status' => 'assigned',
        ]);

        Notification::assertSentTo($companyUser, \App\Notifications\ReservationCreated::class);
        Notification::assertSentTo($uniUser, \App\Notifications\ReservationCreated::class);
    }
}
