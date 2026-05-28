<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Role;
use App\Models\User;
use App\Models\Company;
use App\Models\University;
use App\Models\Contract;
use App\Models\ContractRequest;

class ContractRequestControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_creates_request_and_syncs_contract_when_both_accepted()
    {
        $roleAdmin = Role::create(['name' => 'Администратор']);
        $roleCompany = Role::create(['name' => 'Компания']);
        $roleUni = Role::create(['name' => 'Университет']);

        $adminUser = User::factory()->create(['role_id' => $roleAdmin->id]);
        $companyUser = User::factory()->create(['role_id' => $roleCompany->id]);
        $uniUser = User::factory()->create(['role_id' => $roleUni->id]);

        $company = Company::create(['user_id' => $companyUser->id, 'name' => 'C', 'description' => 'd', 'contact_info' => 'c', 'inn' => '123', 'website' => '']);
        $university = University::create(['user_id' => $uniUser->id, 'name' => 'U', 'inn' => '1', 'contact_person' => 'X', 'position' => 'P', 'phone' => '111']);

        $this->actingAs($adminUser);

        $response = $this->post('/contract-requests', [
            'company_id' => $company->id,
            'university_id' => $university->id,
            'company_accept' => 1,
            'university_accept' => 1,
        ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contracts', [
            'company_id' => $company->id,
            'university_id' => $university->id,
            'status' => 'active',
        ]);

        $this->assertDatabaseCount('contract_requests', 0);
    }

    public function test_accept_endpoints_create_contract_and_remove_request()
    {
        $roleAdmin = Role::create(['name' => 'Администратор']);
        $roleCompany = Role::create(['name' => 'Компания']);
        $roleUni = Role::create(['name' => 'Университет']);

        $adminUser = User::factory()->create(['role_id' => $roleAdmin->id]);
        $companyUser = User::factory()->create(['role_id' => $roleCompany->id]);
        $uniUser = User::factory()->create(['role_id' => $roleUni->id]);

        $company = Company::create(['user_id' => $companyUser->id, 'name' => 'C', 'description' => 'd', 'contact_info' => 'c', 'inn' => '123', 'website' => '']);
        $university = University::create(['user_id' => $uniUser->id, 'name' => 'U', 'inn' => '1', 'contact_person' => 'X', 'position' => 'P', 'phone' => '111']);

        $cr = ContractRequest::create([
            'company_id' => $company->id,
            'university_id' => $university->id,
            'company_accept' => false,
            'university_accept' => false,
        ]);

        $this->actingAs($adminUser);

        $resp1 = $this->put("/contract-requests/{$cr->id}/accept-company");
        $resp1->assertSessionHas('success');

        $this->assertDatabaseHas('contract_requests', [
            'id' => $cr->id,
            'company_accept' => 1,
        ]);

        $resp2 = $this->put("/contract-requests/{$cr->id}/accept-university");
        $resp2->assertSessionHas('success');

        $this->assertDatabaseHas('contracts', [
            'company_id' => $company->id,
            'university_id' => $university->id,
            'status' => 'active',
        ]);

        $this->assertDatabaseCount('contract_requests', 0);
    }
}
