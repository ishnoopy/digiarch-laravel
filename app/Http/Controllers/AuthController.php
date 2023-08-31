<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Model
use App\Models\User;
use App\Models\Department;

// Repositories (Services)
use App\Repositories\UserRepository;

// DTOs
use App\DTOs\CreateUserDTO;
use App\DTOs\LoginUserDTO;

class AuthController extends Controller
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $loginUserDTO = new LoginUserDTO();
        $loginUserDTO->email_address = $request->email;
        $loginUserDTO->password = $request->password;

        $user = $this->userRepository->login($loginUserDTO);
        
        if ($user) {
            // Authentication passed...
            session(['user_id' => $user->id]);
            session(['department_id' => $user->department->id]);

            if ($user->is_admin == 1) {
                session(['is_admin' => true]); 
                return redirect()->route('admin-dashboard');
            } else {
                session(['is_admin' => false]);
                return redirect()->route('dashboard');
            }
        }

        return redirect()->route('login')->withInput()->withErrors(['error' => 'Invalid credentials.'])->withInput();
    }

    public function showSignUpView() {
        $departments = Department::all();

        return view('auth.signup', ['departments' => $departments]);
    }

    public function signup(Request $request) {

        $userDTO = new CreateUserDTO();
        $userDTO->first_name = $request->first_name;
        $userDTO->last_name = $request->last_name;
        $userDTO->email_address = $request->email;
        $userDTO->password = $request->password;
        $userDTO->department_id = $request->department_id;
        $userDTO->is_admin = 0;

        // Check if email already exists.
        if ($this->userRepository->checkIfEmailExists($userDTO->email_address)) {
            return redirect()->route('signup')->withErrors(['email' => 'Email already taken.'])->withInput();
        }

        $this->userRepository->createUser($userDTO);

        return redirect()->route('signup')->with('success', 'Account created successfully.');
    }

    public function logout() {
        session()->flush();
        return redirect()->route('login');
    }
}
