<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users'; // Specify the actual table name
    protected $fillable = ['first_name', 'last_name', 'email_address', 'password', 'is_admin']; // Fillable properties

    // Automatically manage timestamps
    public $timestamps = true;
}
