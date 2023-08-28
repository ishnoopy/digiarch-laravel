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
  <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>
<body>
  <!-- NAVIGATION BAR -->
  <nav id="link-top">
    @include('shared.header')
  </nav>

  </nav>
  <!-- MAIN CONTENT -->
  <main>
    <section class="admin-dashboard">
      <div class="admin-dashboard__container">
        <h2 class="admin-dashboard__title">Admin Dashboard</h2>
        <div class="admin-dashboard__buttons">
          <button class="admin-dashboard__button" data-page="{{ route('users-table') }}">
            <i class="fas fa-users admin-dashboard__icon"></i>
            <span class="admin-dashboard__label">Manage Accounts</span>
          </button>
          <button class="admin-dashboard__button" data-page="{{ route('thesis-form') }}">
            <i class="fas fa-file-alt admin-dashboard__icon"></i>
            <span class="admin-dashboard__label">Manage Files</span>
          </button>
          <button class="admin-dashboard__button" data-page="{{ route('department-form') }}">
            <i class="fa-solid fa-school admin-dashboard__icon"></i>
            <span class="admin-dashboard__label">Add Department</span>
          </button>
          <button class="admin-dashboard__button" data-page="{{ route('course-form') }}">
            <i class="fa-solid fa-user-graduate admin-dashboard__icon"></i>
            <span class="admin-dashboard__label">Add Course</span>
          </button>
        </div>
        <div class="message">
        @if(session('message'))
          <p class="success">{{session('message')}}</p>
        @endif
        @if(session('error'))
          <p class="error">{{session('error')}}</p>
        @endif
      </div>
        <div class="admin-dashboard__content-container"></div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  @include('shared.footer')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/header.js') }}"></script>
  <script src="{{ asset('js/admin-dashboard.js') }}"></script>
</body>
</html>