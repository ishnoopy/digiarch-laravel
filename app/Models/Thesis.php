<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    protected $table = 'thesis'; // Specify the actual table name
    protected $fillable = ['title', 'department_id', 'course_id', 'author', 'abstract', 'file_url', 'view_count', 'download_count', 'published_year', 'keywords'];

    // Automatically manage timestamps
    public $timestamps = true;

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
