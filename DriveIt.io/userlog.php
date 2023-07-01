<!DOCTYPE html>
<html>
	<head>
		<title>USER LOGIN</title>
		<link rel="stylesheet" href="styleuser.css">
		
	</head>
	<script>
  function validateForm() {
    let x = document.forms["Login-Form"]["email"].value;
    let y = document.forms["Login-Form"]["password"].value;
	if (x == "" && y== "") {
      alert("Login Information Missing.");
      return false;
    }
	else if (x == "")
	{
		alert("Please Enter Your E-mail Address.");
      return false;
	}
	else if(y== "")
	{
		alert("Please Enter Your Password.");
      return false;
	}
    
  }
  </script>
<body>
<div class="topnat">
 		<a href=index.php>Back</a>
		</div>
	<div class="LoginForm">
		<form name="Login-Form" action="userlogin.php" onsubmit="return validateForm()" method="post">
		<h2>USER LOGIN</h2>
		<label>Enter Email:</label>
		<input type="email" name="email" placeholder="Email"/><br>
		<br>
		<label>Enter Password:</label>
		<input type="password" name="password" placeholder="Password"/><br>
		<br>
		<input type="submit" name="submit" value="LOGIN" class="btn-login"/><br>
		<div class="USERSIUP">
		<label>Don't have an account</label>
		<a href=usersign.php>Sign Up</a>
		</div>

	</form>	
		</div>
</body>
</html>	