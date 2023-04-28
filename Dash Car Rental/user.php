<!DOCTYPE html>
<html>
	<head>
		<title>USER</title>
		<link rel="stylesheet" href="styleuser.css">
		<link rel="stylesheet" type= "text/css" 
        href ="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
	</head>
	
<body>
	<form action="userlog.php" method="post">
		<h2>WELCOME</h2>
		<?php if (isset($_GET['error'])) { ?>
			<p class="error"><?php echo $_GET['error']; ?></p>
		<?php } ?>	
		<input type="submit" name="submit" value="LOGIN" class="btn-login"/>
	</form>	
	<form action="usersign.php" method="post">
		<?php if (isset($_GET['error'])) { ?>
			<p class="error"><?php echo $_GET['error']; ?></p>
		<?php } ?>	
		<input type="submit" name="submit" value="SIGNUP" class="btn-signup"/>
	</form>	
</body>
</html>	