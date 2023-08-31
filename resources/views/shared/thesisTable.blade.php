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
  <link rel="stylesheet" href="{{ asset('css/thesisTable.css') }}">
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
    <form class="filter-form" action="{{ route('filter-thesis') }}" method="post">
        @csrf
        <label for="year">Filter by year:</label>
        <select name="year" id="year">
          <option value="">All Years</option>
          @foreach ($years as $year)
          <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
          @endforeach
        </select>

        <label for="department">Filter by department:</label>
        <select name="department" id="department">
          <option value="">All Departments</option>
          @foreach ($departments as $department)
            <option value="{{ $department->id }}" {{old('department') == $department->id ? 'selected' : ''}} >{{ $department->name }}</option>
          @endforeach
        </select>

        <label for="topic">Filter by topic:</label>
        <select name="topic" id="topic">
          <option value="">All topics</option>
          <option value="{{  old('topic')}}" selected hidden>{{  old('topic') == ''? 'All topics': old('topic') }}</option>
          @foreach ($topics as $topic)
            <option value="{{ $topic }}" {{ old('topic') === $topic ? 'selected' : '' }}>{{ $topic }}</option>
          @endforeach
         
        </select>

        <label for="author">Filter by author:</label>
        <select name="author" id="author">
          <option value="">All Authors</option>
          @foreach ($authors as $author)
            <option value="{{ $author }}" {{ old('author') == $author ? 'selected': '' }} >{{ $author}}</option>
          @endforeach
        </select>

        <input type="submit" value="Filter">
      </form>

      <a class="upload-thesis-btn" href="{{ route('thesis-form') }}"> <i class="fa-solid fa-circle-plus"></i> Upload Thesis</a>


      <table>
        <tr>
          <th>Thesis Title</th>
          <th>Author</th>
          <th>Year</th>
          <th>Department</th>
          <th>Course</th>
          <th>Actions</th>
        </tr>
        @foreach ($theses as $thesis)
        <tr>
          <td>{{ $thesis->title }}</td>
          <td>{{ $thesis->formattedAuthors }}</td>
          <td>{{ $thesis->published_year }}</td>
          <td>{{ $thesis->departmentName }}</td>
          <td>{{ $thesis->courseName }}</td>
          <td>
            <div class="actions-div">
              @if (session('is_admin'))
                <form action="{{ route('delete-thesis', ['id' => $thesis->id]) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </form>
                <a class="btn" href="/documents/edit/{{$thesis->id}}"><i class="fas fa-edit"></i></a>
              @endif
              <a href="{{ route('thesis-details', ['id' => $thesis->id]) }}" class="btn"><i class="fa-solid fa-eye"></i></a>
            </div>
          </td>
        </tr>
        @endforeach
      </table>
    </section>
  </main>

  <!-- FOOTER -->
  @include('shared.footer')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/header.js') }}"></script>
</body>
</html>