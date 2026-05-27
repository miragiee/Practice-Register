<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Models\Role;
use App\Models\User;
use App\Models\University;
use App\Models\Company;
use App\Models\Internship;
use App\Models\Student;
use App\Models\StudentInternship;

class DocumentUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_or_university_can_upload_document()
    {
        Storage::fake('public');

        $roleAdmin = Role::create(['name' => 'Администратор']);
        $roleUni = Role::create(['name' => 'Университет']);
        $roleCompany = Role::create(['name' => 'Компания']);

        $uniUser = User::factory()->create(['role_id' => $roleUni->id]);
        $companyUser = User::factory()->create(['role_id' => $roleCompany->id]);

        $university = University::create(['user_id' => $uniUser->id, 'name' => 'U', 'inn' => '1', 'contact_person' => 'X', 'position' => 'P', 'phone' => '111']);
        $company = Company::create(['user_id' => $companyUser->id, 'name' => 'C', 'description' => 'd', 'contact_info' => 'c', 'inn' => '123', 'website' => '']);

        $direction = \App\Models\Direction::create(['name' => 'D', 'description' => 'd']);

        $internship = Internship::create([
            'university_id' => $university->id,
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDays(10)->toDateString(),
            'description' => 'desc',
            'capacity' => 3,
        ]);

        $student = Student::create(['full_name' => 'Ivan', 'university_id' => $university->id, 'direction_id' => $direction->id, 'course' => 1, 'email' => 'a@b.test']);

        $studentInternship = StudentInternship::create(['student_id' => $student->id, 'company_id' => $company->id, 'internship_id' => $internship->id, 'status' => 'completed']);

        // Company uploads
        $this->actingAs($companyUser);

        Notification::fake();

        $file = UploadedFile::fake()->create('report.pdf', 100);

        $response = $this->post('/documents/upload', [
            'student_internship_id' => $studentInternship->id,
            'file' => $file,
            'type' => 'closing',
        ]);

        $response->assertSessionHas('success');

        Notification::assertSentTo($companyUser, \App\Notifications\DocumentUploaded::class);

        Storage::disk('public')->assertExists('documents/' . $file->hashName());
    }
}
