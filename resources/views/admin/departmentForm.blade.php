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
      <h2 class="title">Add department</h2>

      <div class="message">
        @if(session('message'))
          <p class="success">{{session('message')}}</p>
        @endif
        @if(session('error'))
          <p class="error">{{session('error')}}</p>
        @endif
      </div>
        
      <form action="{{ route('add-department') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Enter department name">
        <input type="submit" value="Add">
      </form>
      </div>
    </section>
  </main>
</body>
</html>
