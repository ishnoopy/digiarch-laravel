<?php

namespace App\DTOs;

class CreateUserDTO {
    public int $department_id;
    public string $first_name;
    public string $last_name;
    public string $email_address;
    public string $password;
    public int $is_admin;
}