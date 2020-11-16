<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<div class="row">
  <h1 class="col-6">Title:</h1>
  <button class=col-1>
    <a href = "{{ route('posts.edit', ['post'=>$post['id']]) }}"> 
      Edit
    </a>
  </button>
</div>

<h2> {{$post['title']}} </h2>

<h3>Content:</h3>
<h3>{{$post['content']}}</h3>

<h3>Likes:</h3>
<h3>{{$totalLikes}}</h3>


  <form class="col-4" style="margin-top:5rem" method="POST" action="{{ route('comment', ['post'=>$post['id']]) }}">
    @csrf
    <h3>Comments:</h3>
    </div>
      <textarea type = "text" name = "comment" required></textarea>
      <br/>
      <button type="submit" value="Submit">Submit</button>
      <button style="margin-left:10rem">
        <a href="{{ route('like', ['post'=>$post['id']]) }}">
          @if($hasLiked)  
            Dislike
          @else
            Like
          @endif
        </a>
      </button>
  </form>


@foreach( $comments as $comment)
  <div class="card">
    <p>{{ $comment['name'] }}:</p>
    <p>{{ $comment['content'] }}</p>
  </div>
@endforeach
