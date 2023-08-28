<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use model
use App\Models\User;
use App\Models\Thesis;
use App\Models\Department;
use App\Models\Course;
use App\Models\Search;

use Illuminate\Support\Facades\Route;


class UserController extends Controller
{
    public function getUserDetails() {
        $user = User::where('id', session('user_id'))->first();
        return view('user.dashboard', ['user' => $user]);
    }

    public function getAllThesis() {
        $theses = Thesis::with('department', 'course')->get();
        $departments = Department::all();
        $courses = Course::all();
    
        $topics = $this->getAllTopics();
        $allAuthors = $this->getAllAuthors(); // Use a different name to store all authors
        $allYears = $this->getAllYears();

        // Format author and keywords data for each thesis
        foreach ($theses as $thesis) {
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

        }
    
        return view('shared.thesisTable', ['theses' => $theses, 'departments' => $departments, 'courses' => $courses, 'topics' => $topics, 'authors' => $allAuthors, 'years' => $allYears]);
    }

    public function getFormattedThesis() {
        $theses = Thesis::with('department', 'course')->get();
        $departments = Department::all();
        $courses = Course::all();
    
        $topics = $this->getAllTopics();
        $allAuthors = $this->getAllAuthors(); // Use a different name to store all authors
        $allYears = $this->getAllYears();

        // Format author and keywords data for each thesis
        foreach ($theses as $thesis) {
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

        }
    
        return $theses;
    }

    public function getThesisById(){
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
    
            // Increment view count
            $this->incrementViewCount();

        return view('shared.thesisView', ['thesis' => $thesis]);
        
    }

    public function filterThesis(Request $request) {
         // Fetch the filter parameters from the request
        $year = $request->input('year');
        $departmentId = $request->input('department');
        $topic = $request->input('topic');
        $author = $request->input('author');

        $query = Thesis::with('department', 'course');

        //apply filters
        if ($year) {
            $query->where('published_year', $year);
        }

        if($departmentId) {
            $query->where('department_id', $departmentId);
        }

        if($topic) {
            $query->where('keywords', 'LIKE', '%' . $topic . '%');
        }

        if($author) {
            $query->where('author', 'LIKE', '%' . $author . '%');
        }

        $theses = $query->get();
        
        foreach ($theses as $thesis) {
            $thesis->departmentName = $thesis->department->name;
            $thesis->courseName = $thesis->course->name;
        }

        $years = $this->getAllYears();
        $departments = Department::all();
        $courses = Course::all();
        $topics = $this->getAllTopics();
        $authors = $this->getAllAuthors();
        // Format author and keywords data for each thesis


         // Flash the form input into the session
        $request->flash();

        return view('shared.thesisTable', ['theses' => $theses, 'departments' => $departments, 'courses' => $courses, 'years' => $years, 'topics' => $topics, 'authors' => $authors]);
    }
    
    public function getAllYears() {
        $theses = Thesis::all();
        $years = array();
    
        foreach ($theses as $thesis) {
            $years[] = $thesis->published_year;
        }
    
        $years = array_unique($years);
        sort($years);
    
        return $years;
    }

    public function getAllAuthors() {
        $theses = Thesis::all();
        $allAuthors = array();

        foreach ($theses as $thesis) {
            $authors = json_decode($thesis->author, true);

            foreach ($authors as $author) {
                $trimmedAuthor = trim($author); // Remove leading and trailing spaces
                $allAuthors[] = $trimmedAuthor;
    
            }
        }
        $allAuthors = array_unique($allAuthors); // Remove duplicates
        sort($allAuthors);    
    
        return $allAuthors;
    }

    public function getAllTopics() {
        $theses = Thesis::all();
        $topics = array();
    
        foreach ($theses as $thesis) {
            $keywords = $thesis->keywords;
            $keywordsArray = json_decode($keywords, true);
            $topics = array_merge($topics, $keywordsArray);
        }
    
        $topics = array_unique($topics);
        sort($topics);
    
        return $topics;
    }
    
    public function incrementViewCount() {
        $id = Route::current()->parameter('id');
        $thesis = Thesis::findOrFail($id);
        $thesis->view_count += 1;
        $thesis->save();
    }

    public function incrementDownloadCount(Request $request) {
        $id = Route::current()->parameter('id');
        $thesis = Thesis::findOrFail($id);
        $thesis->download_count += 1;
        $thesis->save();
    }

    public function showSearchView() {
        $theses = $this->getFormattedThesis();
        $departments = Department::all();
        $courses = Course::all();
    
        $topics = $this->getAllTopics();
        $allAuthors = $this->getAllAuthors(); // Use a different name to store all authors
        $allYears = $this->getAllYears();

        return view('user.search', ['theses' => $theses, 'departments' => $departments, 'courses' => $courses, 'topics' => $topics, 'authors' => $allAuthors, 'years' => $allYears]);
    }

    public function searchThesis(Request $request) {
        $query = trim($request->input('search'));
        $query = str_replace('"', '', $query); // Remove double quotes (") from query

        $topics = $this->getAllTopics();



        $theses = Thesis::with('department', 'course')
            ->where('title', 'LIKE', '%' . $query . '%')
            ->orWhere('published_year', 'LIKE', '%' . $query . '%')
            ->orWhereHas('department', function ($departmentQuery) use ($query) {
                $departmentQuery->where('name', 'LIKE', '%' . $query . '%');
            })
            ->orWhereHas('course', function ($courseQuery) use ($query) {
                $courseQuery->where('name', 'LIKE', '%' . $query . '%');
            })
            ->orWhereRaw('LOWER(keywords) like ?', ['%' . strtolower($query) . '%'])
            ->get();

   

        foreach ($theses as $thesis) {
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
        }

        $topics = array_map('trim', $topics); // Remove leading and trailing spaces
        $query = strtolower($query); // Convert query to lowercase
         // Check if the lowercase searched query is in the lowercase topics array
        if (in_array($query, array_map('strtolower', $topics))) {
            // Create or update search log entry
            $searchLog = Search::firstOrNew(['keyword' => $query]);
            $searchLog->count++;
            $searchLog->save();
        }

        return view('user.search', ['theses' => $theses, 'topics' => $topics]);
    }
}