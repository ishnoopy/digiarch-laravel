<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// models
use App\Models\User;
use App\Models\Department;
use App\Models\Course;
use App\Models\Thesis;
use App\Models\Search;

use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    public function deleteUser(Request $request) {
        $id = Route::current()->parameter('id');
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin-dashboard')->with('message', 'User deleted successfully.');
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
                $user = User::create([
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'email_address' => $row['email_address'],
                    'password' => password_hash($row['password'], PASSWORD_DEFAULT),
                    'is_admin' => 0
                ]);

            }
    
            return redirect()->route('admin-dashboard')->with('message', 'Accounts created successfully.');
        } catch (\Exception $error) {
            return redirect()->route('admin-dashboard')->with('error', 'Error creating accounts.');
        }
    }
    
    public function showUsersTable() {
        $users = User::all();
        return view('admin.usersTable', ['users' => $users]);
    }

    public function showThesisForm() {
        $departments = Department::all();
        $courses = Course::all();
        return view('admin.thesisForm', ['departments' => $departments, 'courses' => $courses]);
    }

    public function addThesis(Request $request) {
        $title = $request->title;
        $abstract = $request->abstract;
        $author = $request->author;
        $course = $request->course;
        $department = $request->department;
        $published_year = $request->published_year;
        $keywords = $request->keywords;
        $file = $request->file('file');

        // Convert comma-separated keywords to array
        $keywordArray = explode(',', $keywords);
        $authorArray = explode(',', $author);
        $keywordsJson = json_encode($keywordArray);
        $authorsJson = json_encode($authorArray);

        $uniqueFileName = uniqid() . '_' . $file->getClientOriginalName();

        $file->move(public_path('thesis'), $uniqueFileName);

        $thesis = Thesis::create([
            'title' => $title,
            'abstract' => $abstract,
            'author' => $authorsJson,
            'keywords' => $keywordsJson,
            'course_id' => $course,
            'department_id' => $department,
            'published_year' => $published_year,
            'file_url' => $uniqueFileName
        ]);

        return redirect()->route('admin-dashboard')->with('message', 'Thesis added successfully.');
    }

    public function deleteThesis() {
        $id = Route::current()->parameter('id');
        $thesis = Thesis::findOrFail($id);
        // Delete file
        unlink(public_path('thesis/' . $thesis->file_url));
        $thesis->delete();

     

        return redirect()->route('admin-dashboard')->with('message', 'Thesis deleted successfully.');
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

    public function showCourseForm(){
        $departments = Department::all();
        return view('admin.courseForm', ['departments' => $departments]);
    }

    public function addCourse(Request $request) {
        $name = $request->name;
        $department = $request->department;

        $course = Course::create([
            'name' => $name,
            'department_id' => $department
        ]);

        return redirect()->route('admin-dashboard')->with('message', 'Course added successfully.');
    }

    public function addDepartment(Request $request){
        $name = $request->name;
        $department = Department::create([
            'name' => $name
        ]);

        return redirect()->route('admin-dashboard')->with('message', 'Department added successfully.');
    }
    

    public function showReportsView() {
        $theses = Thesis::all()->sort();
        $searched_topics = Search::all()->sortByDesc('count');

        return view('admin.reports', ['theses' => $theses, 'searched_topics' => $searched_topics]);
    }
}
