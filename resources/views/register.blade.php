<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<header class="w3-container w3-teal">
  <h1>Register</h1>
</header>

<div class="w3-container w3-half w3-margin-top">
<form class="w3-container w3-card-4" method="POST" action="{{ route('register') }}">
  @csrf
  <label>Name:</label>
  <input class="w3-input" type = "text" name = "name" required/>
  <br/>
  <label>Email:</label>
  <input class="w3-input" type = "email" name = "email" required/>
  <br/>
  <label>Password:</label>
  <input class="w3-input" type = "password" name = "password" required/>
  <br/>
  <label>Retype Your Password:</label>
  <input class="w3-input" type = "password" name = "password_confirmation" required/>
  <br/>
  <button type="submit" value="Submit">Submit</button>
</form>

</div>

</body>
</html> 
