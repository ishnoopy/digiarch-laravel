<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DIGIARCH</title>
   <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Oswald&family=Raleway&family=Roboto:wght@700&display=swap" rel="stylesheet" />
  <!-- FONT AWESOME KIT -->
  <script src="https://kit.fontawesome.com/feb316d0c3.js" crossorigin="anonymous"></script>
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/search.css') }}">
</head>
<body>
  <!-- NAVIGATION BAR -->
  <nav id="link-top">
    @include('shared.header')
  </nav>

  </nav>
  <!-- MAIN CONTENT -->
  <main>
    <section class="container">
      <div class="search-container">
        <form action="{{ route('search-thesis') }}" method="GET">
          @csrf
          <label for="q">Search:</label>
          <input type="text" id="q" name="search" placeholder="Search for year, program, title, topic">
          <input type="submit" value="Search">
        </form>
        <div class="topics-container">
          <div class="topics">
            <a href="{{ route('search-thesis', ['search' => '']) }}">All</a>
            @foreach ($topics as $topic)
            <a href="{{ route('search-thesis', ['search' => $topic]) }}">{{ $topic }}</a>
            @endforeach
          </div>
        </div>
      </div>

      <div class="result-container">
        <div class="result">

          <div class="result-list">
            @foreach ($theses as $thesis)
            <div class="result-item">
              <h3>{{ $thesis->title }}</h3>
              <p>Author/s: {{ $thesis->formattedAuthors }}</p>
              <p>Year Published: {{ $thesis->published_year }}</p>
              <p>Department: {{ $thesis->departmentName }}</p>
              <p>Course: {{ $thesis->courseName }}</p>
              <p>Keywords : {{ $thesis->formattedKeywords }}</p>
              <a href="{{ route('thesis-details', ['id' => $thesis->id]) }}" class="view_btn">View</a>
            </div>
            @endforeach
          </div>
        
      </div>
      </div>
    </section>
  </main>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/header.js') }}"></script>
</body>
</html>