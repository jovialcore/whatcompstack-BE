<?php

namespace Tests\Feature;

use App\Models\Company;
use Tests\Mocks\MockCompany;
use Tests\TestCase;
use Tests\Mocks\MockCompanyData;

class CompanyTest extends TestCase
{
    private function mock_company_model($mock_data) {
        $this->app->bind(Company::class, function () use ($mock_data) {
            return new MockCompany($mock_data);
        });
    }    
    public function test_should_get_all_companies_when_there_is_no_search_term_in_query_string()
    {
        $mock_data = (new MockCompanyData())->get_mock_data_for_all_companies();
        $this->mock_company_model($mock_data);
        $response = $this->getJson('/api/companies');
        $response->assertStatus(200);
        $responseData = $response->json();
        $this->assertCount(3, $responseData['data']);
    }

    public function test_should_get_all_companies_when_query_string_contains_a_search_term_parameter()
    {
        $mock_data = (new MockCompanyData())->get_mock_data_for_search_term_companies();
        $this->mock_company_model($mock_data);
        $response = $this->getJson('/api/companies?term=tech');
        $response->assertStatus(200);
        $responseData = $response->json();
        $this->assertCount(2, $responseData['data']);
    }

    protected function tearDown(): void
    {
        $this->app->forgetInstance(Company::class);
        parent::tearDown();
    }
}
