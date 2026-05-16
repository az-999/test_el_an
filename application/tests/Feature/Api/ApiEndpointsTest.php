<?php

namespace Tests\Feature\Api;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiEndpointsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_orders_returns_403_without_key(): void
    {
        $response = $this->getJson('/api/orders?dateFrom=2024-01-01&dateTo=2024-01-31');

        $response->assertStatus(403)
            ->assertJson(['error' => 'Token invalid or empty']);
    }

    public function test_orders_returns_403_with_invalid_key(): void
    {
        $response = $this->getJson('/api/orders?dateFrom=2024-01-01&dateTo=2024-01-31&key=wrong');

        $response->assertStatus(403);
    }

    public function test_orders_returns_400_on_invalid_dates(): void
    {
        $response = $this->getJson('/api/orders?dateFrom=invalid&dateTo=2024-01-31&key=test-api-key');

        $response->assertStatus(400);
    }

    public function test_orders_returns_paginated_data(): void
    {
        $from = Carbon::now()->subDays(30)->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        $response = $this->getJson("/api/orders?dateFrom={$from}&dateTo={$to}&key=test-api-key&limit=10");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'current_page',
                'per_page',
                'total',
            ])
            ->assertJsonPath('per_page', '10');

        $this->assertGreaterThan(0, $response->json('total'));
    }

    public function test_sales_endpoint_works(): void
    {
        $from = Carbon::now()->subDays(30)->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        $this->getJson("/api/sales?dateFrom={$from}&dateTo={$to}&key=test-api-key")
            ->assertStatus(200)
            ->assertJsonStructure(['data', 'total']);
    }

    public function test_incomes_endpoint_works(): void
    {
        $from = Carbon::now()->subDays(30)->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        $this->getJson("/api/incomes?dateFrom={$from}&dateTo={$to}&key=test-api-key")
            ->assertStatus(200)
            ->assertJsonStructure(['data', 'total']);
    }

    public function test_stocks_endpoint_returns_today_data(): void
    {
        $today = Carbon::today()->format('Y-m-d');

        $response = $this->getJson("/api/stocks?dateFrom={$today}&key=test-api-key");

        $response->assertStatus(200);
        $this->assertGreaterThan(0, $response->json('total'));
    }

    public function test_response_hides_internal_ids(): void
    {
        $from = Carbon::now()->subDays(7)->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        $data = $this->getJson("/api/sales?dateFrom={$from}&dateTo={$to}&key=test-api-key&limit=1")
            ->json('data');

        $this->assertNotEmpty($data);
        $this->assertArrayNotHasKey('id', $data[0]);
    }
}
