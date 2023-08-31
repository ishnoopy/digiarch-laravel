<?php

namespace App\Repositories;

use App\Models\Thesis;

// DTOs
use App\DTOs\CreateThesisDTO;

class ThesisRepository {
  protected Thesis $thesis;

  public function __construct(Thesis $thesis) {
    $this->thesis = $thesis;
  }

  public function getAllThesis() {
    return Thesis::with('department', 'course')->all();
  }

  public function getThesisById(int $id) {
    return Thesis::with('department', 'course')->findOrFail($id);
  }

  public function getAllPublishedThesis() {
    return Thesis::with('department', 'course')->where('course_id', '!=', 13)->get();
  }

  public function getThesisByCourseId(int $course_id) {
    return Thesis::with('department', 'course')->where('course_id', $course_id)->get();
  }

  public function createThesis(CreateThesisDTO $thesisDTO) {
    $thesis = $this->thesis->create([
      'department_id' => $thesisDTO->department_id,
      'course_id' => $thesisDTO->course_id,
      'title' => $thesisDTO->title,
      'author' => $thesisDTO->author,
      'abstract' => $thesisDTO->abstract,
      'file_url' => $thesisDTO->file_url,
      'keywords' => $thesisDTO->keywords,
      'published_year' => $thesisDTO->published_year,
    ]);

    return $thesis;
  }

  public function unlistThesis(int $course_id) {
    $theses = $this->thesis->where('course_id', $course_id)->get();

    foreach($theses as $thesis) {
      $thesis->course_id = 13;
      $thesis->department_id = 8;
      $thesis->save();
    }

    return $thesis;
  }

  public function unlistThesisByDepartmentId(int $department_id) {
    $theses = $this->thesis->where('department_id', $department_id)->get();

    foreach($theses as $thesis) {
      $thesis->course_id = 13;
      $thesis->department_id = 8;
      $thesis->save();
    }

    return true;
  }
}