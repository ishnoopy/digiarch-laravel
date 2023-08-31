<?php
namespace App\Repositories;

use App\Models\Course;

use App\DTOs\CreateCourseDTO;

class CourseRepository {
  protected Course $course;

  public function __construct(Course $course) {
    $this->course = $course;
  }

  public function getAllCourses() {
    return Course::with('department')->get();
  }

  public function findCourseById(int $id) {
    return Course::with('department')->findOrFail($id);
  }

  public function getCoursesByDepartmentId(int $department_id) {
    if($department_id == 5) {
      return Course::with('department')->get();
    } else {
      return Course::with('department')->where('department_id', $department_id)->get();
    }
  }
  
  public function createCourse(CreateCourseDTO $courseDTO) {
    $course = $this->course->create([
      'department_id' => $courseDTO->department_id,
      'name' => $courseDTO->name,
    ]);

    return $course;
  }

  public function editCourse(int $id, CreateCourseDTO $courseDTO) {
    $course = $this->course->find($id);

    $updatedData = [
        'department_id' => $courseDTO->department_id,
        'name' => $courseDTO->name,
    ];

    $course->update($updatedData);

    return $course;
  }

  public function deleteCourse(int $id) {
    $course = $this->course->find($id);

    $course->delete();

    return $course;
  }

  public function unlistCoursesByDepartmentId(int $department_id) {
    $courses = $this->course->where('department_id', $department_id)->get();

    foreach($courses as $course) {
      $course->department_id = 8;
      $course->save();
    }

    return true;
  }


}