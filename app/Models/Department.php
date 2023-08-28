<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments'; // Specify the actual table name
    protected $fillable = ['name']; // Fillable properties

    // Automatically manage timestamps
    public $timestamps = true;

    public function theses()
    {
        return $this->hasMany(Thesis::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
