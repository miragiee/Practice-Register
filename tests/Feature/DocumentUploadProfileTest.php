<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Role;
use App\Models\User;
use App\Models\Company;
use App\Models\University;
use App\Models\Internship;
use App\Models\Student;
use App\Models\StudentInternship;

class DocumentUploadProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_can_upload_document_for_their_student_internship()
    {
        Storage::fake('public');

        $roleCompany = Role::create(['name' => 'Компания']);
        $roleUni = Role::create(['name' => 'Университет']);

        $companyUser = User::factory()->create(['role_id' => $roleCompany->id]);
        $uniUser = User::factory()->create(['role_id' => $roleUni->id]);

        $company = Company::create(['user_id' => $companyUser->id, 'name' => 'C', 'description' => 'd', 'contact_info' => 'c', 'inn' => '123', 'website' => '']);
        $university = University::create(['user_id' => $uniUser->id, 'name' => 'U', 'inn' => '1', 'contact_person' => 'X', 'position' => 'P', 'phone' => '111']);

        $internship = Internship::create(['university_id' => $university->id, 'start_date' => now()->toDateString(), 'end_date' => now()->addDays(5)->toDateString(), 'description' => 'd', 'capacity' => 2]);

        $direction = \App\Models\Direction::create(['name' => 'D', 'description' => 'd']);

        $student = Student::create(['full_name' => 'Ivan', 'university_id' => $university->id, 'direction_id' => $direction->id, 'course' => 1, 'email' => 'a@b.test']);

        $si = StudentInternship::create(['student_id' => $student->id, 'company_id' => $company->id, 'internship_id' => $internship->id, 'status' => 'assigned']);

        $this->actingAs($companyUser);

        $file = UploadedFile::fake()->create('doc.pdf', 100);

        $response = $this->post('/documents/upload', [
            'student_internship_id' => $si->id,
            'file' => $file,
            'type' => 'closing',
        ]);

        $response->assertSessionHas('success');

        Storage::disk('public')->assertExists('documents/' . $file->hashName());
    }
}
