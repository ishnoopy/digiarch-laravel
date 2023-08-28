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
  <link rel="stylesheet" href="{{ asset('css/thesisView.css') }}">
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
      <div class="result-container">
       <div class="result-item">
          <div class="content-header">
            <h1>{{$thesis->title}}</h1>
            <div>
              <p><strong>Author/s:</strong> {{$thesis->formattedAuthors}}</p>
              <p><strong>Abstract:</strong> {{$thesis->abstract}}</p>
              <p><strong>Year Published:</strong> {{$thesis->published_year}}</p>
              <p><strong>Department:</strong> {{$thesis->departmentName}}</p>
              <p><strong>Course:</strong> {{$thesis->courseName}}</p>
              <div class="buttons">
                <p><a href="{{ url()->previous() }}">Back</a></p>
                <p><a href="{{ asset('thesis/'.$thesis->file_url) }}" data-target-id="{{$thesis->id}}" class="download_btn" target='_blank'>Download</a></p>
              </div>
            </div>
          </div>
       </div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  @include('shared.footer')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/header.js') }}"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>
  <script src="{{ asset('js/thesisView.js') }}"></script>
</body>
</html>