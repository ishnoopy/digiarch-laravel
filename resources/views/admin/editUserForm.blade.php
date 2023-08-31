<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DIGIARCH</title>
  <!--- FontAwesome Icons -->
  <script src="https://kit.fontawesome.com/feb316d0c3.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/thesisForm.css') }}">
  <link rel="stylesheet" href="{{ asset('css/editUserForm.css') }}">
 
</head>
<body>

  @include('shared.header')

  <main>
    <a class="back-btn" href="{{ route('admin-dashboard') }}"><i class="fa-solid fa-arrow-left"></i></a>
    <section class="container">
      <h2 class="title">Edit User</h2>

      <div class="message">
        @if(session('message'))
          <p class="success">{{session('message')}}</p>
        @endif
        @if(session('error'))
          <p class="error">{{session('error')}}</p>
        @endif
      </div>
        
      <form action="{{ route('edit-user', ['id' => request()->route('id')]) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="department">Department:</label>
        <select name="department_id">
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{$user->department_id == $department->id? 'selected' : ''}}>
                    {{ $department->name }}
                </option>
            @endforeach
        </select>
        
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" placeholder="Enter first name" value="{{$user->first_name}}">
        
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" placeholder="Enter last name" value="{{$user->last_name}}">
        
        <label for="email_address">Email Address:</label>
        <input type="email" name="email_address" placeholder="Enter email address" value="{{$user->email_address}}">
        
        <label for="old_password">Old Password:</label>
        <input type="password" name="old_password" placeholder="Enter old password">
        
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" placeholder="Enter new password">
        
        <label for="confirm_new_password">Confirm New Password:</label>
        <input type="password" name="confirm_new_password" placeholder="Enter confirm new password">
        
        <input type="submit" value="Submit">
      </form>

      </div>
    </section>
  </main>
</body>
</html>
