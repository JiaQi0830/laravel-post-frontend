<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<header class="w3-container w3-teal">
  <h1>login</h1>
</header>

<div class="w3-container w3-half w3-margin-top">

<form class="w3-container w3-card-4" method="POST" action="{{ route('login') }}">
    @csrf
    <label> Email </label>
      <input class="w3-input" type = "email" name = "email" required/>
      <br/>
    <label> password </label>
      <input class="w3-input" type="password" pattern=".{6,}" name = "password" required/>
      <br/>
    <div class="d-flex flex-row justify-content-center align-items-center">
      <button class="w3-button w3-section w3-teal w3-ripple" type="submit" value="Submit">Submit</button>
    </div>
    <div class="d-flex flex-row justify-content-center align-items-center">
      <a href = "{{ route('register.index') }}"> Go to register </a>
    </div>
</form>


</div>

</body>
@if(Session::has('message'))
<script> 
  alert(`{{Session('message')}}`)
</script>
@endif
</html> 
