<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user,email'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Generate unique userID
        $lastUser = User::orderBy('userID', 'desc')->first();
        $nextNumber = $lastUser ? (int)substr($lastUser->userID, 3) + 1 : 1;
        $userID = 'USR' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return User::create([
            'userID' => $userID,
            'username' => explode('@', $input['email'])[0], // Use email prefix as username
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'], // Model will hash it automatically
            'role' => 'user',
            'userStatus' => 'Aktif',
        ]);
    }
}
