<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<h1>Register</h1>
<form method="POST" action="{{ route('register') }}">
  @csrf
  <label>Name:</label>
  <input type = "text" name = "name" required/>
  <br/>
  <label>Email:</label>
  <input type = "email" name = "email" required/>
  <br/>
  <label>Password:</label>
  <input type = "password" name = "password" required/>
  <br/>
  <button type="submit" value="Submit">Submit</button>
</form>