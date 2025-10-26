<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Str;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-admin {email} {password} {--id=ADMIN001} {--username=Admin} {--ic=000000000000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        $userId = $this->option('id');
        $username = $this->option('username');
        $icNumber = $this->option('ic');
        
        // Check if user with this ID or email already exists
        $existingUser = User::where('userID', $userId)->orWhere('email', $email)->first();
        
        if ($existingUser) {
            if ($existingUser->userID === $userId) {
                $this->error("A user with ID '{$userId}' already exists.");
            }
            if ($existingUser->email === $email) {
                $this->error("A user with email '{$email}' already exists.");
            }
            return 1;
        }
        
        try {
            $user = new User();
            $user->userID = $userId;
            $user->username = $username;
            $user->icNumber = $icNumber;
            $user->email = $email;
            $user->role = 'Admin';
            $user->password = $password; // Will be hashed by the model's mutator
            $user->userStatus = 'Aktif';
            $user->remember_token = Str::random(10);
            $user->save();
            
            $this->info("Admin user created successfully!");
            $this->table(['Field', 'Value'], [
                ['userID', $user->userID],
                ['username', $user->username],
                ['email', $user->email],
                ['role', $user->role],
                ['status', $user->userStatus]
            ]);
            
        } catch (\Exception $e) {
            $this->error("Error creating user: " . $e->getMessage());
            $this->error($e->getTraceAsString());
            return 1;
        }
        
        return 0;
    }
}