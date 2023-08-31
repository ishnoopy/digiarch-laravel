<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// models
use App\Models\User;
use App\Models\Department;
use App\Models\Course;
use App\Models\Thesis;
use App\Models\Search;

// Repositories
use App\Repositories\UserRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\CourseRepository;
use App\Repositories\ThesisRepository;

// DTOs
use App\DTOs\CreateUserDTO;
use App\DTOs\LoginUserDTO;
use App\DTOs\CreateThesisDTO;
use App\DTOs\CreateCourseDTO;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct(UserRepository $userRepository, DepartmentRepository $departmentRepository, CourseRepository $courseRepository, ThesisRepository $thesisRepository) {
        $this->userRepository = $userRepository;
        $this->departmentRepository = $departmentRepository;
        $this->courseRepository = $courseRepository;
        $this->thesisRepository = $thesisRepository;
    }

    // DOCU: SHOW VIEWS
    public function showEditUserForm() {
        $id = Route::current()->parameter('id');
        $user = $this->userRepository->findUserById($id);
        $departments = $this->departmentRepository->getAllDepartments();
        return view('admin.editUserForm', ['user' => $user, 'departments' => $departments]);
    }

    public function showEditCourseForm() {
        $id = Route::current()->parameter('id');
        $departments = $this->departmentRepository->getAllDepartments();
        $course = $this->courseRepository->findCourseById($id);
        return view('admin.editCourseForm', ['course' => $course, 'departments' => $departments]);
    }
    
    public function showUsersTable() {
        $users = $this->userRepository->getAllUsers();
        return view('admin.usersTable', ['users' => $users]);
    }

    public function showThesisForm() {
        $departments = $this->departmentRepository->getAllDepartments();
        $courses = $this->courseRepository->getAllCourses();
        return view('admin.thesisForm', ['departments' => $departments, 'courses' => $courses]);
    }

    public function showDepartmentAndCourseView() {
        $id = Route::current()->parameter('id');
        $departments = $this->departmentRepository->getAllDepartments();
        $courses = $this->courseRepository->getCoursesByDepartmentId($id);
        return view('admin.departmentAndCourse', ['departments' => $departments, 'courses' => $courses]);
    }

    public function showeditThesisView() {
        $id = Route::current()->parameter('id');
        $thesis = Thesis::with('department', 'course')->findOrFail($id);
        $departments = Department::all();
        $courses = Course::all();
    
        // Format author and keywords data for thesis
            $authors = $thesis->author; // Assuming 'author' is the JSON field in the database
            $keywords = $thesis->keywords; // Assuming 'keywords' is the JSON field in the database
            
            $authorsArray = json_decode($authors, true);
            $keywordsArray = json_decode($keywords, true);
    
            $authorCount = count($authorsArray);
            $keywordCount = count($keywordsArray);
    
            if ($authorCount > 1) {
                $lastAuthor = array_pop($authorsArray);
                $authorsString = implode(', ', $authorsArray) . ', and ' . $lastAuthor;
            } else {
                $authorsString = $authorsArray[0];
            }
    
            if ($keywordCount > 0) {
                $keywordsString = implode(', ', $keywordsArray);
            } else {
                $keywordsString = 'N/A';
            }
    
            $thesis->formattedAuthors = $authorsString;
            $thesis->formattedKeywords = $keywordsString;
            $thesis->departmentName = $thesis->department->name;
            $thesis->courseName = $thesis->course->name;
    
        return view('admin.editThesis', ['thesis' => $thesis, 'courses' => $courses, 'departments' => $departments]);
    }

    public function showCourseForm(){
        $departments = Department::all();
        return view('admin.courseForm', ['departments' => $departments]);
    }

    public function showReportsView(Request $request)
    {
        $theses = Thesis::all()->sort();
        $searched_topics = Search::all()->sortByDesc('count');


        return view('admin.reports', ['theses' => $theses, 'searched_topics' => $searched_topics]);
    }

    // DOCU: USER MANAGEMENT

    public function deleteUser(Request $request) {
        try {
            $id = Route::current()->parameter('id');
    
            $this->userRepository->deleteUser($id);
    
            return redirect()->route('admin-dashboard')->with('message', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin-dashboard')->with('error', 'An error occurred while deleting the user.');
        }
    }    

    public function editUser(Request $request) {
        try {
            $id = Route::current()->parameter('id');
            $request->validate([
                'department_id' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email_address' => 'required',
                'old_password' => 'required',
                'new_password' => 'required',
                'confirm_new_password' => 'required|same:new_password',
            ]);

            $loginUserDTO = new LoginUserDTO();
            $loginUserDTO->email_address = $request->email_address;
            $loginUserDTO->password = $request->old_password;

            $user = $this->userRepository->login($loginUserDTO);

            if(!$user) {
                return redirect()->route('edit-user-form', ['id'=>$id])->with('error', 'Password is incorrect.');
            }

            $editUserDTO = new CreateUserDTO();
            $editUserDTO->department_id = $request->department_id;
            $editUserDTO->first_name = $request->first_name;
            $editUserDTO->last_name = $request->last_name;
            $editUserDTO->email_address = $request->email_address;
            $editUserDTO->password = $request->new_password;
            
            $this->userRepository->editUser($id, $editUserDTO);

            return redirect()->route('edit-user-form', ['id' => $id])->with('message', 'User edited successfully.');
            
        } catch (\Exception $e) {
            $id = Route::current()->parameter('id');
            return redirect()->route('edit-user-form', ['id' => $id])->with('error', $e->getMessage());
        }
    }

    public function addAccountViaCSV(Request $request){
        try {
            $file = $request->file('csv');
            $csvData = file_get_contents($file);
            $csvData = preg_replace('/^\x{FEFF}/u', '', $csvData);
            $rows = array_map("str_getcsv", explode("\n", $csvData));
            $header = array_shift($rows);
    
            // Filter out rows with null values
            $filteredRows = array_filter($rows, function ($row) {
                return !empty(array_filter($row));
            });
    
            $csv = array();
            foreach ($filteredRows as $row) {
                $csv[] = array_combine($header, $row);
            }
    
            foreach ($csv as $row) {
                $createUserDTO = new CreateUserDTO();
                $createUserDTO->department_id = $row['department_id'];
                $createUserDTO->first_name = $row['first_name'];
                $createUserDTO->last_name = $row['last_name'];
                $createUserDTO->email_address = $row['email_address'];
                $createUserDTO->password = $row['password'];
                $createUserDTO->is_admin = 0;
                $user = $this->userRepository->createUser($createUserDTO);
            }
    
            return redirect()->route('admin-dashboard')->with('message', 'Accounts created successfully.');
        } catch (\Exception $error) {
            return redirect()->route('admin-dashboard')->with('error', 'Error creating accounts.');
        }
    }

    // DOCU: COURSE MANAGEMENT

    public function getCoursesByDepartment() {
        try {
            $departmentId = Route::current()->parameter('id');
            $courses = $this->courseRepository->getCoursesByDepartmentId($departmentId);
            return response()->json($courses);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching courses.'], 500);
        }
   }

   // DOCU: THESIS MANAGEMENT
   public function addThesis(Request $request) {
        try {
            // Validate the input data
            $request->validate([
                'author' => 'required',
                'keywords' => 'required',
                'file' => 'required|file',
            ]);

            // Extract and process authors and keywords
            $authors = explode(',', $request->author);
            $keywords = explode(',', $request->keywords);

            // Move the uploaded file to the designated directory
            $uniqueFileName = uniqid() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('thesis'), $uniqueFileName);

            // Create the DTO with the input data
            $createThesisDTO = new CreateThesisDTO();
            $createThesisDTO->title = $request->title;
            $createThesisDTO->abstract = $request->abstract;
            $createThesisDTO->author = json_encode($authors);
            $createThesisDTO->keywords = json_encode($keywords);
            $createThesisDTO->course_id = $request->course;
            $createThesisDTO->department_id = $request->department;
            $createThesisDTO->published_year = $request->published_year;
            $createThesisDTO->file_url = $uniqueFileName;

            // Create the thesis record
            $thesis = $this->thesisRepository->createThesis($createThesisDTO);

            // Redirect with a success message
            return redirect()->route('admin-dashboard')->with('message', 'Thesis added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin-dashboard')->with('error', $e->getMessage());

        }
    }

    public function deleteThesis() {
        $id = Route::current()->parameter('id');
        $thesis = Thesis::findOrFail($id);
        // Delete file
        unlink(public_path('thesis/' . $thesis->file_url));
        $thesis->delete();

        return redirect()->route('admin-dashboard')->with('message', 'Thesis deleted successfully.');
    }

    public function editThesis(Request $request) {
        $id = Route::current()->parameter('id');
        $thesis = Thesis::findOrFail($id);
        
        $title = $request->title;
        $abstract = $request->abstract;
        $author = $request->author;
        $course = $request->course;
        $department = $request->department;
        $published_year = $request->published_year;
        $keywords = $request->keywords;
        $file = $request->file('file');
    
        $authorArray = explode(',', $author);

        // Remove any leading or trailing spaces from each author name
        $authorArray = array_map('trim', $authorArray);

        // Remove any empty elements from the array
        $authorArray = array_filter($authorArray);

        // Combine the author names into a string separated by commas
        $authorsString = implode(', ', $authorArray);

        // Now $authorsString contains the author names without the "and"

        // Convert comma-separated keywords to array
        $keywordArray = explode(',', $keywords);
        $authorArray = explode(',', $authorsString);
        $keywordsJson = json_encode($keywordArray);
        $authorsJson = json_encode($authorArray);
    
        if($file) {
            $uniqueFileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path('thesis'), $uniqueFileName);

            $thesis->update([
                'file_url' => $uniqueFileName
            ]);
        }

        $thesis->update([
            'title' => $title,
            'abstract' => $abstract,
            'author' => $authorsJson,
            'keywords' => $keywordsJson,
            'course_id' => $course,
            'department_id' => $department,
            'published_year' => $published_year,            
        ]);
    
        return redirect()->route('admin-dashboard')->with('message', 'Thesis edited successfully.');
    }

    // DOCU: COURSE MANAGEMENT

    public function addCourse(Request $request) {
        $name = $request->name;
        $department = $request->department;

        $course = Course::create([
            'name' => $name,
            'department_id' => $department
        ]);

        return redirect()->route('admin-dashboard')->with('message', 'Course added successfully.');
    }

    public function editCourse(Request $request) {
        $request->validate([
            'name' => 'required',
            'department_id' => 'required'
        ]);

        $id = Route::current()->parameter('id');
        $editCourseDTO = new CreateCourseDTO();
        $editCourseDTO->name = $request->name;
        $editCourseDTO->department_id = $request->department_id;

        $course = $this->courseRepository->editCourse($id, $editCourseDTO);

       

        return redirect()->route('edit-course-form', ['id' => $id])->with('message', 'Course edited successfully.');
    }

    public function deleteCourseAndUpdateThesis(Request $request) {
        $courseId = Route::current()->parameter('id');
        $departmentId = $request->department_id;
        
        $theses = $this->thesisRepository->getThesisByCourseId($courseId);

        if(count($theses) > 0) {
            $this->thesisRepository->unlistThesis($courseId);
        }
        $this->courseRepository->deleteCourse($courseId);

        return redirect()->route('departments-courses', ['id' => $departmentId])->with('message', 'Course deleted successfully.');
    }

    // DOCU: DEPARTMENT MANAGEMENT

    public function addDepartment(Request $request){
        $name = $request->name;
        $department = Department::create([
            'name' => $name
        ]);

        return redirect()->route('admin-dashboard')->with('message', 'Department added successfully.');
    }

    public function editDepartment(Request $request) {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
        ]);

        $id = Route::current()->parameter('id');

        $this->departmentRepository->editDepartmentById($id, $request->name);

        return redirect()->route('departments-courses', ['id' => $request->id])->with('message', 'Department edited successfully.');
    }

    public function deleteDepartmentAndUpdateThesisAndUser(Request $request) {
        $departmentId = Route::current()->parameter('id');
        $this->thesisRepository->unlistThesisByDepartmentId($departmentId);
        $this->courseRepository->unlistCoursesByDepartmentId($departmentId);
        
        $users = $this->userRepository->getUsersByDepartmentId($departmentId);
        foreach($users as $user) {
            $this->userRepository->transferUser($user->id, 8);
        }

        $this->departmentRepository->deleteDepartmentById($departmentId);

        return redirect()->route('admin-dashboard')->with('message', 'Department deleted successfully.');
    }

    // DOCU: REPORTS
    public function exportReportsToCSV()
    {
        $reportData = Thesis::all()->sort();
        $searchedTopics = Search::all()->sortByDesc('count');

        $csvFileName = 'reports_' . Str::slug(now()) . '.csv';
        $csvFilePath = public_path('reports/' . $csvFileName);

        $csvFile = fopen($csvFilePath, 'w');
        fputcsv($csvFile, ['ID', 'Title', 'View Count']); // CSV header row

        foreach ($reportData as $row) {
            fputcsv($csvFile, [$row->id, $row->title, $row->view_count]);
        }

        fputcsv($csvFile, []); // Empty line to separate sections

        fputcsv($csvFile, ['ID', 'Keyword', 'Search Count']); // CSV header row for searched topics

        foreach ($searchedTopics as $topic) {
            fputcsv($csvFile, [$topic->id, $topic->keyword, $topic->count]);
        }

        fclose($csvFile);

        return Response::download($csvFilePath, $csvFileName)->deleteFileAfterSend(true);
    }
}
