<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">
<div class="row">
  @if(Session::get('role') == 2)
    <button class="col-1">
      <a href="{{ route('posts.create') }}"> create new post</a>
    </button>
  @endif
  @if(Session::has('role'))
    <button class="col-1">
    <a href="{{ route('logout') }}">Logout</a>
    </button>
  @else
  <button class="col-1">
    <a href="{{ route('login') }}">Login</a>
  </button>
  <button class="col-1">
    <a href="{{ route('register') }}">Register</a>
  </button>
  @endif
</div>

<!-- w3-content defines a container for fixed size centered content, 
and is wrapped around the whole page content, except for the footer in this example -->
<div class="w3-content" style="max-width:1400px">

<!-- Header -->
<header class="w3-container w3-center w3-padding-32"> 
  <h1><b>MY BLOG</b></h1>
  <p>Welcome to the blog of <span class="w3-tag">Test</span></p>
</header>

<!-- Grid -->
<div class="w3-row">

<!-- Blog entries -->
<div class="w3-col l8 s12">
  <!-- Blog entry -->
@foreach($posts as $post)
  <div class="w3-card-4 w3-margin w3-white">
    <div class="w3-container">
      <h3><b>{{ $post['title'] }}</b></h3>
      <h5>{{ $post['author'] }}, <span class="w3-opacity">{{ date('d-M-y', strtotime($post['created_at'])) }}</span></h5>
    </div>

    <div class="w3-container">
      <div class="w3-row">
        <div class="w3-col m8 s12">
        <a href="{{ route('posts.show', ['post' => $post['id']]) }}">
          <p>
            <button class="w3-button w3-padding-large w3-white w3-border"><b>READ MORE »</b></button></p>
        </a>
        </div>
      </div>
    </div>
  </div>
@endforeach
  <hr>
</div>

<!-- END GRID -->
</div><br>

<!-- END w3-content -->
</div>

<!-- Footer -->
<footer class="w3-container w3-dark-grey w3-padding-32 w3-margin-top">
  <button class="w3-button w3-black w3-disabled w3-padding-large w3-margin-bottom">Previous</button>
  <button class="w3-button w3-black w3-padding-large w3-margin-bottom">Next »</button>
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

</body>
</html>
