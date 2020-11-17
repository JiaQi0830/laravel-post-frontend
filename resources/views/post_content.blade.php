<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<div class="row">
  <h1 class="col-6">Title:</h1>
  @if(Session::get('role') == 2)
    <button class=col-1>
      <a href = "{{ route('posts.edit', ['post'=>$post['id']]) }}"> 
        Edit
      </a>
    </button>
  @endif
</div>

<h2> {{$post['title']}} </h2>

<h3>Content:</h3>
<h3>{{$post['content']}}</h3>

<h3>Likes:</h3>
<h3>{{$totalLikes}}</h3>

@if(Session::has('role'))
<h3  style="margin-top:5rem" >Comments:</h3>
  <form class="col-4"method="POST" action="{{ route('comment', ['post'=>$post['id']]) }}">
    @csrf
      <textarea type = "text" name = "comment" required></textarea>
      <br/>
      <button type="submit" value="Submit">Submit</button>     
      @if(Session::get('role') != 2)
          <button style="margin-left:10rem">
            <a href="{{ route('like', ['post'=>$post['id']]) }}">
              @if($hasLiked == 1)  
                Dislike
              @else
                Like
              @endif
            </a>
          </button>
        @endif
  </form>
  @endif


@foreach( $comments as $comment)
  <div class="card">
    <p>{{ $comment['name'] }}:</p>
    <p>{{ $comment['content'] }}</p>
  </div>
@endforeach
