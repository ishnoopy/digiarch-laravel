<?php

namespace App\DTOs;

class CreateThesisDTO {
  public int $department_id;
  public int $course_id;
  public string $title;
  public string $author;
  public string $abstract;
  public string $file_url;
  public string $published_year;
  public string $keywords;
}