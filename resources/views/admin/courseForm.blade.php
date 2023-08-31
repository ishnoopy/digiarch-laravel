<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DIGIARCH</title>
  <script src="https://kit.fontawesome.com/feb316d0c3.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="{{ asset('css/thesisForm.css') }}">
</head>
<body>
  @include('shared.header')


  <main>
    <a class="back-btn" href="{{ route('departments-courses', ['id' => 5]) }}"><i class="fa-solid fa-arrow-left"></i></a>

    <section class="container">

      <h2 class="title">Add courses</h2>

      <div class="message">
        @if(session('message'))
          <p class="success">{{session('message')}}</p>
        @endif
        @if(session('error'))
          <p class="error">{{session('error')}}</p>
        @endif
      </div>
        
      <form action="{{ route('add-course') }}" method="POST">
        @csrf
        <label for="department">Department:</label>
        <select name="department" id="department">
          @foreach ($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }}</option>
          @endforeach
        </select>
        <input type="text" name="name" placeholder="Enter course name">
        <input type="submit" value="Add">
      </form>
      </div>
    </section>
  </main>
</body>
</html>
