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


