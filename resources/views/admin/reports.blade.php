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
   <main class="report-main">
    <h1>Reports according to:</h1>
    <button id="toggleButton">Show Table</button>
    <a href="{{ route('export-reports') }}" class="btn btn-primary">Export CSV</a>


    <h2>Documents by Views</h2>
    <table class="table-report table" style="display: none;">
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>View Count</th>
      </tr>
      @foreach ($theses as $thesis)
        <tr>
          <td>{{$thesis->id}}</td>
          <td>{{$thesis->title}}</td>
          <td>{{$thesis->view_count}}</td>
        </tr>
      @endforeach
    </table>
    <div>
        <canvas id="viewsChart" data-documents="{{$theses}}" class="chart"></canvas>
    </div>


    <h2>Topics by Searches</h2>
      <table class="table-report table" id="keywordsTable" style="display: none;">
        <tr>
          <th>ID</th>
          <th>Keyword</th>
          <th>Search Count</th>
        </tr>
        @foreach ($searched_topics as $topic)
        <tr>
          <td>{{$topic->id}}</td>
          <td>{{$topic->keyword}}</td>
          <td>{{$topic->count}}</td>
          </tr>
        @endforeach
      </table>
      <div>
        <canvas id="keywordsChart" class="chart" data-topics="{{$searched_topics}}"></canvas>
      </div>
  </main>

  

  <!-- FOOTER -->
  @include('shared.footer')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="{{ asset('js/header.js') }}"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>
  <script src="{{ asset('js/reportsChart.js') }}"></script>
</body>
</html>