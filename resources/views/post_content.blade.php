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
  <div class="w3-card-4 w3-margin w3-white">
    <div class="w3-container">
      <h3><b>{{$post['title']}}</b></h3>
      <h5>{{$post['author']}}, <span class="w3-opacity">{{ date('d-M-y', strtotime($post['created_at'])) }}</span></h5>
    </div>

    <div class="w3-container">
      <p>{{$post['content']}}</p>
      <div class="w3-row">
        @if(Session::get('role') == 2)
          <div class="w3-col m1 s12">
            <p>
            <a href = "{{ route('posts.edit', ['post'=>$post['id']]) }}"> 
                <button class="w3-button w3-padding-large w3-white w3-border"><b>Edit</b></button>
              </a>
            </p>
          </div>
        @endif
        @if(Session::get('role') == 1)
          <div class="w3-col m7 s12">
            <p>
             <a href="{{ route('like', ['post'=>$post['id']]) }}">
                <button class="w3-button w3-padding-large w3-white w3-border">
                  <b>
                  @if($hasLiked == 1)  
                    Dislike
                  @else
                    Like
                  @endif
                  </b>
                </button>
              </a>
            </p>
          </div>
        @endif
        <div>
          <p><span class="w3-padding-large w3-right"><b>Likes  </b> <span class="w3-badge">{{$totalLikes}}</span></span></p>
        </div>
      </div>
    </div>
  </div>
  <hr>

  <div class="w3-card-4 w3-margin w3-white">
    <div class="w3-container">
      <h3><b>Comments:</b></h3>
    </div>

    <div class="w3-container">
      @if(Session::has('role'))
        <form class="col-4"method="POST" action="{{ route('comment', ['post'=>$post['id']]) }}">
        @csrf
          <textarea style="width:100%" type = "text" name = "comment" required></textarea>
          <button type="submit" value="Submit">Submit</button>     
        </form>
      @endif
      @foreach( $comments as $comment)
        <p><i><b>{{ $comment['name'] }}:</b></i>   {{ $comment['content'] }}</p>
      @endforeach
    </div>
  </div>
</div>
</div>

</body>
</html>
