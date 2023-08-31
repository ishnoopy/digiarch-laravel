<?php

namespace App\Repositories;
use App\Models\User;


use App\DTOs\CreateUserDTO;
use App\DTOs\LoginUserDTO;

class UserRepository {
    protected User $user;

    public function __construct(User $user) {
      $this->user = $user;
    }

    public function checkIfEmailExists(string $email) {
      return User::where('email_address', $email)->exists();
    }

    public function login(LoginUserDTO $userDTO){
      $user = User::with('department')->where('email_address', $userDTO->email_address)->first();
      if ($user && password_verify($userDTO->password, $user->password)) {
        return $user;
      }
      return null;
    }

    public function getAllUsers() {
      return User::with('department')->get();
    }

    public function getUsersByDepartmentId(int $department_id) {
      if($department_id == 5) {
        return User::with('department')->get();
      } else {
        return User::with('department')->where('department_id', $department_id)->get();
      }
    }

    public function findUserById(int $id) {
      return User::with('department')->findOrFail($id);
    }

    public function createUser(CreateUserDTO $userDTO) {
      $user = $this->user->create([
        'department_id' => $userDTO->department_id,
        'first_name' => $userDTO->first_name,
        'last_name' => $userDTO->last_name,
        'email_address' => $userDTO->email_address,
        'password' => password_hash($userDTO->password, PASSWORD_DEFAULT),
        'is_admin' => 0
      ]);

      return $user;
    }

    public function deleteUser(int $id) {
      $user = User::findOrFail($id);
      $user->delete();
    }

    public function editUser(int $id, CreateUserDTO $userDTO) {
      $user = User::findOrFail($id);
      $user->update([
        'department_id' => $userDTO->department_id,
        'first_name' => $userDTO->first_name,
        'last_name' => $userDTO->last_name,
        'email_address' => $userDTO->email_address,
        'password' => password_hash($userDTO->password, PASSWORD_DEFAULT),
        'is_admin' => 0
      ]);
    }
    
    public function transferUser(int $id, int $department_id) {
      $user = User::findOrFail($id);
      $user->update([
        'department_id' => $department_id,
      ]);
    }

}