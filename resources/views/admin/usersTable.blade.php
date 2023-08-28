<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DIGIARCH</title>
  <link rel="stylesheet" href="{{ asset('css/usersTable.css') }}">
</head>
<body>
  <form action="/admin-dashboard/create-accounts" method="POST" enctype="multipart/form-data">
    @csrf
    <h1>Add Faculty Account:</h1>
    <input type="file" name="csv" class="csv_file">
    <input type="submit" value="Upload">
  </form>
      <table>
          <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Password (hashed)</th>
              <th>Action</th>
          </tr>
          @foreach ($users as $user)
          <tr>
              <td>{{ $user->first_name }}</td>
              <td>{{ $user->last_name }}</td>
              <td>{{ $user->email_address }}</td>
              <td>{{ $user->password }}</td>
              <td> 
                <form action="{{ route('delete-user', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </form>
              </td>
          </tr>
          @endforeach
      </table>
</body>
</html>