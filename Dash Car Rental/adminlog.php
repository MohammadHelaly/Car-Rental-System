<!DOCTYPE html>
<html>
	<head>
		<title>ADMIN LOGIN</title>
		<link rel="stylesheet" href="styleadmin.css">
		<link rel="stylesheet" type= "text/css" 
        href ="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
		
	</head>
	<script>
  function validateForm() {
    let x = document.forms["Login-Form"]["email"].value;
    let y = document.forms["Login-Form"]["password"].value;
	if (x == "" && y== "") {
      alert("all field must be filled out");
      return false;
    }
	else if (x == "")
	{
		alert("email field must be filled out");
      return false;
	}
	else if(y== "")
	{
		alert("password field must be filled out");
      return false;
	}
    
  }
  </script>
<body>
<div class="container">
            
            <div class ="row">
            <div class ="col-md-6">
                <h2> Login into the system. </h2>
				<form name="Login-Form" action="adminlogin.php" onsubmit="return validateForm()" method="post">
                    <div class ="form-group">
                        <label>Email</label>
                        <input type="email" name = "email" class="form-control" required>
                    </div> 
                    <div class ="form-group">
                        <label>Password</label>
                        <input type="password" name = "password" class="form-control" required> <br>
</div>
                    <button type ="submit" class="btn btn-primary"> Login </button>
                    </form>
</body>
</html>	
