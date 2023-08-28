<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DIGIARCH</title>
  <link rel="stylesheet" href="{{ asset('css/editThesisForm.css') }}">
  <link rel="stylesheet" href="{{ asset('css/thesisForm.css') }}">
</head>
<body>

  <main>

    <a id="back-btn" href="{{route('documents')}}">Go back</a>

    <section class="container">
      <h2 class="title">Edit Thesis</h2>

      <div class="message">
        @if(session('message'))
          <p class="success">{{session('message')}}</p>
        @endif
        @if(session('error'))
          <p class="error">{{session('error')}}</p>
        @endif
      </div>
        
      <form action="/documents/edit/{{$thesis->id}}" method="POST" enctype="multipart/form-data">
        @method('PUT') <!-- Use the PUT method for updating -->
        @csrf
        <label for="department">Department:</label>
        <select name="department" id="department">
          @foreach ($departments as $department)
            <option value="{{ $department->id }}" {{ $department->id == $thesis->department_id ? 'selected' : '' }} >{{ $department->name }}</option>
          @endforeach
        </select>
        <label for="course">Course:</label>
        <select name="course" id="course">
          @foreach ($courses as $course)
            <option value="{{ $course->id }}" {{ $course->id == $thesis->course_id ? 'selected' : '' }} >{{ $course->name }}</option>
          @endforeach
        </select>
        <label for="title">Title:</label>
        <input type="text" name="title" placeholder="Enter thesis title" value="{{$thesis->title}}">
        <label for="author">Author:</label>
        <input type="text" name="author" placeholder="Enter author name" value="{{$thesis->formattedAuthors}}">
        <label for="published_year">Published Year:</label>
        <input type="text" name="published_year" placeholder="Enter published year" value="{{$thesis->published_year}}">
        <label for="abstract">Abstract:</label>
        <textarea name="abstract" id="abstract" cols="30" rows="10" placeholder="Enter thesis abstract">{{$thesis->abstract}}</textarea>
        <label for="keywords">Keywords:</label>
        <input type="text" name="keywords" placeholder="Enter Keywords" value="{{$thesis->formattedKeywords}}">
        <label for="file">Thesis File:</label>
        <input type="file" name="file">
        <input type="submit" value="Upload">
      </form>
      </div>
    </section>
  </main>
</body>
</html>
