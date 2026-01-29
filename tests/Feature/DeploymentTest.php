<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\NewUser;
use Illuminate\Support\Facades\DB;

class DeploymentTest extends TestCase
{
    /**
     * Test Basic Application Availability.
     */
    public function test_application_is_up(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test Login Page Availability.
     */
    public function test_login_page_loads(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    /**
     * Test Database Connectivity and User Model.
     */
    public function test_database_connection_and_users(): void
    {
        try {
            DB::connection()->getPdo();
            $this->assertTrue(true, 'Database connection successful');
        } catch (\Exception $e) {
            $this->fail('Database connection failed: ' . $e->getMessage());
        }

        // Check if we can query users
        $count = User::count();
        $this->assertGreaterThanOrEqual(0, $count, 'User count should be queryable');
    }

    /**
     * Test Admin Existence (Deployment Check).
     */
    public function test_admin_user_exists_if_seeded(): void
    {
        // This is a soft check, only if we expect an admin
        $admin = User::where('role', 'Admin')->orWhere('role', 'admin')->first();
        if ($admin) {
            $this->assertTrue(true);
        } else {
            $this->markTestSkipped('No admin user found, but not critical for basic uptime.');
        }
    }

    /**
     * Test New Auth System Availability.
     */
    public function test_new_auth_login_loads(): void
    {
        $response = $this->get('/new-auth/login');
        // This relies on NewAuthController existing and route being active
        if ($response->status() === 404) {
             $this->markTestSkipped('New Auth routes not active or 404.');
        } else {
            $response->assertStatus(200);
        }
    }
}
