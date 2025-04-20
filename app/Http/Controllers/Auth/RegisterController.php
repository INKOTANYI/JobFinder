<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        // Trim email to remove spaces
        $data['email'] = trim($data['email']);
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:15', 'unique:users,phone'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            \Log::error('Validation failed: ' . json_encode($validator->errors()));
        }

        return $validator;
    }

    protected function create(array $data)
    {
        try {
            return User::create([
                'name' => $data['name'],
                'email' => trim($data['email']),
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
                'role' => 'user',
            ]);
        } catch (\Exception $e) {
            \Log::error('User creation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    protected function registered(Request $request, $user)
    {
        \Log::info('User registered: ' . $user->role);
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }
}
