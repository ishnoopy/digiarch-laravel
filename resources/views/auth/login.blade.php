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
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
  @include('shared.header')
<main>
    <!-- LOGO SLIDE ON LOAD -->
    <div id="hover-onload">
      <img src="/images/logo2.png" alt="image of a logo" />
    </div>
    <!-- FORM -->
    <form id="form-container" action="/login" method="POST">
    @csrf
      <div class="title-container">
        <h1 class="title">Sign in
        </h1>
        <div id="close-btn">
          <a href="{{route('login')}}"><i class="fa-solid fa-xmark"></i>
        </div></a>
      </div>
      <!-- EMAIL CONTAINER -->
      <div id="email-container">
        <h3>Email</h3>
        <div>
          <input type="text" name="email" id="email" placeholder="example@gmail.com" value="{{ old('email') }}" autocomplete="off" required />
        </div>
        <div class="wrong-input">Incorrect Email</div>
      </div>
      <!-- PASSWORD CONTAINER -->
      <div id="password-container">
        <h3>Password</h3>
        <div id="input-container">
          <input type="password" name="password" id="password" placeholder="Enter Password" value="{{ old('password') }}" autocomplete="off" required />
          <div id="show-password">
            <i class="fa-regular fa-eye"></i>
          </div>
        </div>

        @if ($errors->has('error'))
          <div class="error"><p>{{ $errors->first('error') }}</p></div>
        @endif

      </div>
      <!-- SUBMIT PART -->
      <input type="submit" id="login" />
      <div class="sign-up">
      <p>Not yet a user?</p>
        <a href="{{ route('signup') }}">signup!</a>
      </div>
    </form>
  </main>

  <!-- FOOTER -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>