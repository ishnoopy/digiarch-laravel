<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DIGIARCH</title>
  <link rel="stylesheet" href="{{ asset('css/thesisForm.css') }}">
</head>
<body>

  <main>
    <section class="container">
      <h2 class="title">Upload Thesis</h2>

      <div class="message">
        @if(session('message'))
          <p class="success">{{session('message')}}</p>
        @endif
        @if(session('error'))
          <p class="error">{{session('error')}}</p>
        @endif
      </div>
        
      <form action="/thesis-form" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="department">Department:</label>
        <select name="department" id="department">
          @foreach ($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }}</option>
          @endforeach
        </select>
        <label for="course">Course:</label>
        <select name="course" id="course">
          @foreach ($courses as $course)
            <option value="{{ $course->id }}">{{ $course->name }}</option>
          @endforeach
        </select>
        <label for="title">Title:</label>
        <input type="text" name="title" placeholder="Enter thesis title">
        <label for="author">Author:</label>
        <input type="text" name="author" placeholder="Enter author name/s (name1, name2, name3)">
        <label for="published_year">Published Year:</label>
        <input type="text" name="published_year" placeholder="Enter published year">
        <label for="abstract">Abstract:</label>
        <textarea name="abstract" id="abstract" cols="30" rows="10" placeholder="Enter thesis abstract"></textarea>
        <label for="keywords">Keywords:</label>
        <input type="text" name="keywords" placeholder="Enter Keywords">
        <label for="file">Thesis File:</label>
        <input type="file" name="file">
        <input type="submit" value="Upload">
      </form>
      </div>
    </section>
  </main>
</body>
</html>
