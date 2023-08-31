<?php
namespace App\Repositories;
use App\Models\Department;

class DepartmentRepository {
  protected Department $department;

  public function __construct(Department $department) {
    $this->department = $department;
  }

  public function getAllDepartments() {
    return Department::all();
  }

  public function editDepartmentById(int $id, string $name) {
    $department = $this->department->find($id);

    $updatedData = [
        'name' => $name,
    ];

    $department->update($updatedData);

    return $department;
  }

  public function deleteDepartmentById(int $id) {
    $department = $this->department->find($id);

    $department->delete();

    return $department;
  }
}