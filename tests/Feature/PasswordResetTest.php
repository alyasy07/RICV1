<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\NewUser;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class PasswordResetTest extends TestCase
{
    /**
     * Test Simple Password Reset (for existing User model).
     * This controller just displays the link on screen for now.
     */
    public function test_simple_forgot_password_generation(): void
    {
        // 1. Ensure a user exists
        $user = User::first();
        if (!$user) {
            $user = new User();
            $user->userID = 'USR999';
            $user->username = 'TestUser';
            $user->email = 'testuser@example.com';
            $user->password = 'password';
            $user->role = 'user';
            $user->userStatus = 'Aktif';
            $user->save();
        }

        // 2. Request a password reset
        $response = $this->post(route('simple.password.email'), [
            'email' => $user->email,
        ]);

        // 3. Assert it redirects back with status (containing the link)
        $response->assertStatus(302);
        $response->assertSessionHas('status');
        
        // 4. Verify the status contains the link (rudimentary check from controller code)
        $status = session('status');
        $this->assertStringContainsString('http', $status);
    }

    /**
     * Test New Password Reset (for NewUser model).
     * This uses the standard Laravel PasswordBroker.
     */
    public function test_new_auth_forgot_password_email_trigger(): void
    {
        // 1. Ensure a NewUser exists
        $user = NewUser::where('email', 'newtest@example.com')->first();
        if (!$user) {
             $user = NewUser::create([
                'name' => 'New Test',
                'email' => 'newtest@example.com',
                'password' => Hash::make('password'),
                'role' => 'user'
             ]);
        }

        // 2. Request password reset
        // Note: With MAIL_MAILER=log, this shouldn't crash
        $response = $this->post(route('new.password.email'), [
            'email' => 'newtest@example.com',
        ]);

        // 3. Assert success redirect
        $response->assertStatus(302);
        $response->assertSessionHas('status', trans(Password::RESET_LINK_SENT));
    }
}
