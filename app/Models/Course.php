<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = ['name', 'department_id'];

    public $timestamps = true;

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function theses()
    {
        return $this->hasMany(Thesis::class);
    }
}
