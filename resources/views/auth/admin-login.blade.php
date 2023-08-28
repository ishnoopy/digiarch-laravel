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
<main>
    <!-- LOGO SLIDE ON LOAD -->
    <div id="hover-onload">
      <img src="/images/logo2.png" alt="image of a logo" />
    </div>
    <!-- FORM -->
    <form id="form-container" method="POST">
      <div class="title-container">
        <h1 class="title">Sign in
          <div id="title-underline"></div>
        </h1>
        <div id="close-btn">
          <a href="{{ route('home') }}"><i class="fa-solid fa-xmark"></i>
        </div></a>
      </div>
      <!-- EMAIL CONTAINER -->
      <div id="email-container">
        <h3>Email</h3>
        <div>
          <input type="text" name="email" id="email" placeholder="example@gmail.com" autocomplete="off" required />
        </div>
        <div class="wrong-input">Incorrect Email</div>
      </div>
      <!-- PASSWORD CONTAINER -->
      <div id="password-container">
        <h3>Password</h3>
        <div id="input-container">
          <input type="password" name="password" id="password" placeholder="Enter Password" autocomplete="off" required />
          <div id="show-password">
            <i class="fa-regular fa-eye"></i>
          </div>
        </div>
        <div class="wrong-input">Incorrect Password</div>
      </div>
      <!-- SUBMIT PART -->
      <input type="submit" name="login" value="Log in" id="login" />
      <div class="sign-up">
        <p>Not an Admin user?</p>
        <a href="{{ route('login') }}">Click here!</a>
      </div>
    </form>
  </main>

  <!-- FOOTER -->
  @include('shared.footer')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>