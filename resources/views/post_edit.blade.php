<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<form method="POST" action="{{ route('posts.update', ['post'=>$post['id']]) }}">
@csrf
{{ method_field('PUT') }}
  <div class="row">
    <h1 class="col-6">Title:</h1>
  </div>

  <input class="text" name="title" value="{{ $post['title'] }}"/>

  <h3>Content:</h3>
  <input class="text" name="content" value="{{ $post['content'] }}"/>
  <button type="submit" value="Submit">Submit</button>

</form>