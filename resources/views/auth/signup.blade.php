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
  <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
</head>
<body>
<main>
    <div id="hover-onload">
    <img src="/images/logo2.png" alt="image of a logo" />
    </div>
    <!-- FORM -->
    <form id="form-container" action="/signup" method="POST">
      @csrf
      <div class="title-container">
        <h1 class="title">Sign up
          <div id="title-underline"></div>
        </h1>
        <div id="close-btn">
          <a href="{{ route('home') }}"><i class="fa-solid fa-xmark"></i>
        </div></a>
      </div>
      <!-- NAME INPUT -->
      <div id="name-container">
        <h3>First Name</h3>
        <input type="text" name="first_name" id="username" placeholder="e.g. John Doe" autocomplete="off" required />
      </div>
      <div id="name-container">
        <h3>Last Name</h3>
        <input type="text" name="last_name" id="username" placeholder="e.g. Martinez" autocomplete="off" required />
      </div>
      <div id="name-container">
        <h3>Department</h3>
        <select name="department_id" id="department" required>
          <option value="" disabled selected>Select Department</option>
          @foreach ($departments as $department)
          <option value="{{ $department->id }}">{{ $department->name }}</option>
          @endforeach
        </select>
      </div>
      <!-- EMAIL INPUT -->
      <div id="email-container">
        <h3>Email</h3>
        <input type="email" name="email" id="useremail" placeholder="example@gmail.com" autocomplete="off" required />
      </div>
      <!-- PASSWORD INPUT -->
      <div id="password-container">
        <h3>Password</h3>
        <div class="input-container">
          <div class="input">
            <input type="password" name="password" id="password" placeholder="Enter Password" autocomplete="off" required />
            <div class="show-password" id="show-password">
              <i class="fa-regular fa-eye"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- CONFIRM PASSWORD INPUT -->
      <div id="confirm-password-container">
        <h3>Confirm Password</h3>
        <div class="input-container">
          <div class="input">
            <input type="password" name="" id="confirm-password" placeholder="Re-enter Password" autocomplete="off" required />
            <div class="show-password" id="show-reenter-password">
              <i class="fa-regular fa-eye"></i>
            </div>
          </div>
        </div>
      </div>
      <div id="password-mismatch">Password Mismatch</div>
      @if ($errors->has('email'))
          <div class="error"><p>{{ $errors->first('email') }}</p></div>
      @endif

      @if(session('success'))
        <div class="success">{{ session('success') }}</div>
      @endif


      <!-- SUBMIT PART -->
      <input type="submit" name="signup" value="Sign up" id="submit" />
      <p class="sign-in">
        Already have an account? <a href="{{ route('login') }}">Sign in</a>
      </p>
    </form>
  </main>

  <!-- FOOTER -->
  @include('shared.footer')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/signup.js') }}"></script>
</body>
</html>