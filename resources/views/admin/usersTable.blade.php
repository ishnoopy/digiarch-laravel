<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DIGIARCH</title>
  <link rel="stylesheet" href="{{ asset('css/usersTable.css') }}">
</head>
<body>
  <div class="message">
    @if (session('message'))
      <div class="success">
          {{ session('message') }}
      </div>
    @endif

    @if (session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif
  </div>
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
              <th>Department</th>
              <th>Action</th>
          </tr>
          @foreach ($users as $user)
          <tr>
              <td>{{ $user->first_name }}</td>
              <td>{{ $user->last_name }}</td>
              <td>{{ $user->email_address }}</td>
              <td>{{ $user->department->name }}</td>
              <td class="flex"> 
                <a class="btn" href="{{route('edit-user-form', ['id' => $user->id])}}"><i class="fas fa-edit" aria-hidden="true"></i></a>

                <form action="{{ route('delete-user', ['id' => $user->id]) }}" method="GET">
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