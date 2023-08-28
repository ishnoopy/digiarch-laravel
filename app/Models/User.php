<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users'; // Specify the actual table name
    protected $fillable = ['department_id' ,'first_name', 'last_name', 'email_address', 'password', 'is_admin']; // Fillable properties

    public function department() {
        return $this->belongsTo(Department::class);
    }

    // Automatically manage timestamps
    public $timestamps = true;
}
