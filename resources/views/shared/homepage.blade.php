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
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
  <!-- NAVIGATION BAR -->
  <nav id="link-top">
    @include('shared.header')
  </nav>

  </nav>
  <!-- MAIN CONTENT -->
  <main>
  <div class="stem-container strand-container">
      <div>
      </div>
      <a href="{{ route('home') }}">
        <h1>Welcome to DIGIARCH</h1>
      </a>
    </div>
    <div class="container-breather">

      <div class="title">
        <h1>A Digital Thesis Archive System</h1>
      </div>
      <div class="description-container">

        <div class="description">
          <div class="crop"><img src="/images/friendly.png" alt=""></div>
          <h1>User Friendly</h1>

        </div>
        <div class="description">
          <div class="crop"><img src="/images/browse.png" alt=""></div>
          <h1>Store Thesis</h1>

        </div>
        <div class="description">
          <div class="crop"><img src="/images/store.png" alt=""></div>
          <h1>Browse</h1>

        </div>
      </div>
    </div>
  </main>

  <!-- FOOTER -->
  @include('shared.footer')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/header.js') }}"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>