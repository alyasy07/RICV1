<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    protected $maxAttempts = 5;
    protected $decayMinutes = 15;
    
    protected function limiter()
    {
        return app(RateLimiter::class);
    }

    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input('email')).'|'.$request->ip();
    }

    public function showLoginForm()
    {
        return view('new_auth.login');
    }

    public function login(Request $request)
    {
        Log::info('Login attempt started', ['email' => $request->input('email')]);

        // Throttle check
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        Log::info('Credentials validated', ['email' => $credentials['email']]);

        $user = User::where('email', $credentials['email'])->first();

        // Enhanced authentication check
        if (!$user) {
            Log::warning('User not found', ['email' => $credentials['email']]);
            $this->incrementLoginAttempts($request);
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        Log::info('User found', [
            'userID' => $user->userID,
            'role' => $user->role,
            'provided_email' => $credentials['email'],
            'provided_password' => substr($credentials['password'], 0, 3) . '***',
            'stored_hash' => $user->password
        ]);

        // Password verification
        if (!Hash::check($credentials['password'], $user->password)) {
            Log::warning('Password check failed', [
                'email' => $credentials['email'],
                'provided_password' => $credentials['password'],
                'stored_hash' => $user->password,
                'hash_check_result' => Hash::check($credentials['password'], $user->password)
            ]);
            $this->incrementLoginAttempts($request);
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        Log::info('Password verified successfully');

        // Rehash password if needed (uses model's setPasswordAttribute)
        if (Hash::needsRehash($user->password)) {
            $user->password = $credentials['password']; // Model's mutator will hash it
            $user->save();
        }

        Log::info('About to login user');
        Auth::login($user, $request->filled('remember'));
        Log::info('Auth::login called', ['auth_check' => Auth::check(), 'auth_id' => Auth::id()]);
        
        $request->session()->regenerate();
        Log::info('Session regenerated');
        
        $this->clearLoginAttempts($request);

        Log::info('User logged in successfully', [
            'user_id' => $user->userID,
            'email' => $user->email,
            'role' => $user->role
        ]);

        $redirect = $this->authenticated($request, $user);
        Log::info('Redirect response created', ['redirect' => get_class($redirect)]);
        
        return $redirect;
    }

    protected function authenticated(Request $request, $user)
    {
        Log::info('Authenticated method called', [
            'user_role' => $user->role,
            'user_id' => $user->userID
        ]);

        switch (strtolower($user->role)) {
            case 'admin':
                Log::info('Redirecting to admin dashboard');
                return redirect()->intended(route('admin.dashboard'));
            default:
                Log::info('Redirecting to dashboard');
                return redirect()->intended(route('dashboard'));
        }
    }

    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request),
            $this->maxAttempts
        );
    }

    protected function incrementLoginAttempts(Request $request)
    {
        $this->limiter()->hit(
            $this->throttleKey($request),
            $this->decayMinutes * 60
        );
    }

    protected function clearLoginAttempts(Request $request)
    {
        $this->limiter()->clear($this->throttleKey($request));
    }

    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        return back()->withErrors([
            'email' => "Too many login attempts. Please try again in {$seconds} seconds.",
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}