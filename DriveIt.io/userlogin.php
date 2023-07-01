<?php

include "db_conn.php";
session_start();

if(isset($_POST['email']) && isset($_POST['password'])) {
	
	function validate($entry){
		$entry=trim($entry);
		$entry=stripslashes($entry);
		$entry=htmlspecialchars($entry);
		return $entry;
	}	
	
	$email=validate($_POST['email']);
	$password=validate($_POST['password']);
	$v1='@';
	$v2='.';	
	
	if(empty($email) && empty($password)) {
		//alert("Please Enter Your E-mail Address & Password.");
		//header("Location: userlog.php?error=Email and Password required.");
		//exit();
								echo "<script>
            alert('Enter E-mail and Password.');
            </script>";
						header("Refresh:0;userlog.php");
						exit();
	}

	else if(empty($email)) {
		//header("Location: userlog.php?error=Email required.");
		//exit();
										echo "<script>
            alert('Enter E-mail.');
            </script>";
						header("Refresh:0;userlog.php");
						exit();
	}
	
	else if(empty($password)) {
		//header("Location: userlog.php?error=Password required.");
		//exit();
										echo "<script>
            alert('Enter Password.');
            </script>";
						header("Refresh:0;userlog.php");
						exit();
	}
	
	else if(strpos($email,$v1) == false || strpos($email,$v2) == false) {
		//alert("Invalid E-mail Address. Please Re-enter.");
		//header("Location: userlog.php?error=Email invalid.");
		//exit();
										echo "<script>
            alert('Invalid E-mail.');
            </script>";
						header("Refresh:0;userlog.php");
						exit();
	}
	
	
	else{
		$password = md5($password);
		$sql="SELECT * FROM customer WHERE customer_email='$email' AND customer_password='$password'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)!= 1){
								echo "<script>
            alert('Login information incorrect.');
            </script>";
						header("Refresh:0;userlog.php");
						exit();
		}
		else if(mysqli_num_rows($result)== 1){
			$row = mysqli_fetch_assoc($result);
			$_SESSION['ssid'] = $row['customer_id'];    
			//echo 'Welcome, '.$_SESSION['name'].'.';
			header("Location: cusres.php");
			exit();
		}	
	}
	
}

?>