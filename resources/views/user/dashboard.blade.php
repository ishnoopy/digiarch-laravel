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
    <section class="user-dashboard">
      <div class="icon-prof">
        <div class="user-dashboard__container">
          <h2 class="user-dashboard__title">User Details</h2>
            <div>
              <p>First Name: <strong>{{$user->first_name}}</strong></p>
              <p>Last Name: <strong>{{$user->last_name}}</strong></p>
              <p>Email Address: <strong>{{$user->email_address}}</strong></p>
              <p>Date Created: <strong>{{$user->created_at}}</strong></p>
            </div>
          <div class="user-dashboard__content-container"></div>
        </div>
    </section>
  </main>

  <!-- FOOTER -->
  @include('shared.footer')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/header.js') }}"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>