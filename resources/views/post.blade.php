<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

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
@foreach( $posts as $post)
  <div class="card">
    <h1>{{ $post['title'] }}</h1>
    <div class="row">
      <small class="col-1">
        <i>Author: {{ $post['author'] }}</i>
      </small>
      <small class="col-2">
        <i>Create Date: {{ date('d-M-y', strtotime($post['created_at'])) }}</i>
      </small>
      <button class="col-1">
        <a href="{{ route('posts.show', ['post' => $post['id']]) }}">View</a>
      </button>
      
    </div>
  </div>
@endforeach

