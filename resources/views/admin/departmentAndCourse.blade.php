<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>DIGIARCH</title>
   <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Oswald&family=Raleway&family=Roboto:wght@700&display=swap" rel="stylesheet" />
  <!-- FONT AWESOME KIT -->
  <script src="https://kit.fontawesome.com/feb316d0c3.js" crossorigin="anonymous"></script>
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('css/departmentAndCourse.css') }}">
</head>
<body>
  <!-- NAVIGATION BAR -->
  <nav id="link-top">
    @include('shared.header')
  </nav>

  </nav>
  <!-- MAIN CONTENT -->
  <main>

  <div class="flex">
    <a class="add-btn" href="{{ route('department-form') }}"><i class="fa-solid fa-circle-plus"></i>Add Department</a>
    <a class="add-btn" href="{{ route('course-form') }}"><i class="fa-solid fa-circle-plus"></i>Add Course</a>
  </div>  
  <div class="message">
    @if(session('message'))
      <p class="success">{{session('message')}}</p>
    @endif
    @if(session('error'))
      <p class="error">{{session('error')}}</p>
    @endif
  </div>

  <div class="flex">
    <div class="departments-div">
      <h2>Departments</h2>
      <table>
        <thead>
          <tr>
            <th>NAME</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($departments as $department)
          <tr>
            <td>
              <form class="flex edit-department-form" action="{{ route('edit-department', ['id' => $department->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $department->id }}">
                <input type="text" {{ $department->id == 8 || $department->id == 5 ? 'disabled': '' }} name="name" value="{{ $department->name }}" class="department_name" data-default-value="{{ $department->name }}">
              </form>
            </td>
            <td>
              <form class="flex" action="{{ route('delete-department', ['id' => $department->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                @if ($department->id !== 8 && $department->id !== 5)
                <button class="delete-btn" type="submit"><i class="fa-solid fa-circle-xmark"></i></button>
                @endif
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <div class="courses-div">
      <div class="department-filter">
        <h2>Courses According To:</h2>
        @foreach ($departments as $department)
        <a id="filter-link" href="{{ route('departments-courses',['id' => $department->id]) }}">{{$department->name}}</a>
        @endforeach
      </div>
      <table>
        <thead>
          <tr>
            <th>DEPARTMENT</th>
            <th>NAME</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($courses as $course)
          <tr>
              <td>{{ $course->department->name }}</td>
              <td>
                  {{ $course->name }}
              </td>
              <td class="flex">
                @if ($course->id !== 13)
                  <a class="btn" href="{{ route('edit-course-form', ['id' => $course->id]) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                @endif
                <form class="flex" action="{{ route('delete-course', ['id' => $course->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="department_id" value="{{ $course->department_id }}">
                    @if ($course->id !== 13)
                    <button class="delete-btn" type="submit"><i class="fa-solid fa-circle-xmark"></i></button>
                    @endif
                  </form>
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</main>


  <!-- FOOTER -->
  @include('shared.footer')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/header.js') }}"></script>
  <script src="{{ asset('js/departmentAndCourses.js') }}"></script>
</body>
</html>