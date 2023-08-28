<head>
    <title>My App</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
<nav>
  <div id="nav-container">
    <div>
      <h1>
        <a href="/admin_index.php"></a>
      </h1>
      <div id="menu-container">
        <button id="nav-button"><i class="fa-solid fa-bars"></i></button>
      </div>
    </div>
    <ul id="link-container">

      @if(session('is_admin'))
          <li><a class="nav-links" href="{{ route('home') }}">HOME</a></li>
          <li><a class="nav-links" href="{{ route('admin-dashboard') }}">DASHBOARD</a></li>
          <li><a class="nav-links" href="{{ route('documents') }}">DOCUMENTS</a></li>
          <li><a class="nav-links" href="{{ route('reports') }}">REPORTS & ANALYTICS</a></li>
          <li><a class="nav-links" href="{{ route('logout') }}">LOGOUT</a></li>
      @elseif(!session('is_admin'))
          <li><a class="nav-links" href="{{ route('home') }}">HOME</a></li>
          <li><a class="nav-links" href="{{ route('search') }}">SEARCH</a></li>
          <li><a class="nav-links" href="{{ route('dashboard') }}">DASHBOARD</a></li>
          <li><a class="nav-links" href="{{ route('logout') }}">LOGOUT</a></li>
      @endif
    </ul>
  </div>
</nav>