<h1>Create</h1>

<form method="POST" action="{{ route('posts.store') }}">
  @csrf
  <label>Title</label>
  <input style="margin-bottom:10px" type="text" name="title" required/>
  <br/>
  <label>Content</label>
  <textarea style="margin-bottom:10px" type="textbox" name="content" required> </textarea>
  <br/>
  <button type="submit" value="Submit">Submit</button>
</form>

@if(Session::has('message'))
<script> 
  alert(`{{Session('message')}}`)
</script>
@endif