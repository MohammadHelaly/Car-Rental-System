<?php

include "db_conn.php";
session_start();

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmpassword']) && isset($_POST['phone'])&& isset($_POST['city'])) {
	
	function validate($entry){
		$entry=trim($entry);
		$entry=stripslashes($entry);
		$entry=htmlspecialchars($entry);
		return $entry;
	}	
	
	$name=validate($_POST['name']);
	$email=validate($_POST['email']);
	$password=validate($_POST['password']);
	$confirmpassword=validate($_POST['confirmpassword']);
	$phone=validate($_POST['phone']);
	$city=validate($_POST['city']);
	$v1='@';
	$v2='.';
	
	if(empty($name) && empty($email) && empty($password)) {
		//alert("Name , E-mail & Password  Missing.");
		//header("Location: usersign.php?error=Name, Email and Password required.");
		//exit();
					echo "<script>
            alert('E-mail , Name & password missing.');
            </script>";
						header("Refresh:0;usersign.php");
						exit();
	}
	
	else if(empty($email) && empty($password)) {
		//alert("E-mail & Password Missing.");
		//header("Location: usersign.php?error=Email and Password required.");
		//exit();
					echo "<script>
            alert('E-mail and Password missing.');
            </script>";
						header("Refresh:0;usersign.php");
						exit();
	}

	else if(empty($name)) {
		//alert("Name Missing.");
		//header("Location: usersign.php?error=Name required.");
		//exit();
					echo "<script>
            alert('Name required.');
            </script>";
						header("Refresh:0;usersign.php");
						exit();
	}

	else if(empty($email)) {
		//alert("E-mail Missing.");
		//header("Location: usersign.php?error=Email required.");
		//exit();
					echo "<script>
            alert('E-mail required.');
            </script>";
						header("Refresh:0;usersign.php");
						exit();
	}
	
		else if(strpos($email,$v1) == false || strpos($email,$v2) == false) {
		//	alert("E-mail is invalid. Please Re-enter E-mail.");
		//header("Location: usersign.php?error=Email invalid.");
		//exit();
					echo "<script>
            alert('E-mail invalid.');
            </script>";
						header("Refresh:0;usersign.php");
						exit();
	}
	
	else if(empty($password)) {
		//alert("Password Field required.");
		//header("Location: usersign.php?error=Password required.");
		//exit();
					echo "<script>
            alert('Password required.');
            </script>";
						header("Refresh:0;usersign.php");
						exit();
	}
	
	else if(empty($confirmpassword)) {
		//alert("Password confirmation required.");
		//header("Location: usersign.php?error=Password confirmation required.");
		//exit();
					echo "<script>
            alert('Password confirmation required.');
            </script>";
						header("Refresh:0;usersign.php");
						exit();
	}
	
	else if(empty($phone)) {
	//	alert("Phone number required.");
	//header("Location: usersign.php?error=Phone required.");
	//exit();
				echo "<script>
            alert('Phone required.');
            </script>";
						header("Refresh:0;usersign.php");
						exit();
	}
	
	else if(empty($city)) {
	//	alert("City Required to be entered.");
	//header("Location: usersign.php?error=City required.");
	//exit();
				echo "<script>
            alert('City required.');
            </script>";
						header("Refresh:0;usersign.php");
						exit();
	}
	
	else if($password !== $confirmpassword) {
		//alert("Passwords Do not match please try again.");
		//header("Location: usersign.php?error=Password confirmation incorrect.");
		//exit();
					echo "<script>
            alert('Password and confirmation do not match.');
            </script>";
						header("Refresh:0;usersign.php");
						exit();
	}
	
	else{
		$password = md5($password);
		$sql1="SELECT * FROM customer WHERE customer_email='$email'";
		$result=mysqli_query($conn,$sql1);
		if(mysqli_num_rows($result) > 0){
			//alert("E-mail already in use please use another.");
			//header("Location: usersign.php?error=Email already exists.");
			//exit();
			echo "<script>
            alert('E-mail already in use.');
            </script>";
						header("Refresh:0;usersign.php");
						exit();
		}
		else if(mysqli_num_rows($result) == 0){
			$sql2="INSERT INTO customer(customer_name,customer_email,customer_password,customer_phone,customer_city) VALUES('$name','$email','$password','$phone','$city')";
			$result2=mysqli_query($conn,$sql2);
			$sql3="SELECT * FROM customer WHERE customer_email='$email' AND customer_password='$password'";
			$result3=mysqli_query($conn,$sql3);
			if(mysqli_num_rows($result3)== 1){
			$row = mysqli_fetch_assoc($result3);
			$_SESSION['ssid'] = $row['customer_id'];  
			//echo 'Welcome, '.$_SESSION['name'].'.';
			header("Location:cusres.php");
			//echo "<script>
            //alert('Welcome!.');
            //</script>";
			//			header("Refresh:0;cusres.php");
			//exit();
		    }
	    }	
    }
}
?>