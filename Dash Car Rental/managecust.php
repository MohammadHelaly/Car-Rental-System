<!DOCTYPE html>
<html>
	<head>
		<title>MANAGE CUSTOMERS</title>
		<link rel="stylesheet" href="styleadmin.css">
	</head>
<body>
		<div class="topnav">
 		<a href=advsearch.php>Advanced Search</a>
 		<a href=manageres.php> Manage Resrvations</a>
  		<a href=managecar.php>Manage Cars</a>
 		<a class="active" href=managecust.php>Manage Customers</a>
		<a href=managepay.php>Manage Payments</a>
		<a href=manageoff.php>Manage Offices</a>
		<a class="logout" href=index.php>logout</a>
		</div>
		
		<?php if (isset($_GET['error'])) { ?>
		<p class="error"><?php echo $_GET['error']; ?></p>
		<?php } ?>
		<h3>VIEW ALL CUSTOMERS</h3>
		<form method ="post">
		<button type="submit" name="viewCustomer" value="View Customers" class="btn btn-primary"> View customers</button>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['viewCustomer'])){
		$query = "SELECT * FROM customer";
		$result= mysqli_query($conn, $query);
		echo "<table border='1'>";
		echo "<tr><td>CustomerID</td><td>Name</td><td>Email</td><td>Password</td><td>Phone</td><td>City</td><tr>";
		while($row = mysqli_fetch_assoc($result))
		{
		  
		   echo "<tr><td>{$row['customer_id']}</td><td>{$row['customer_name']}</td><td>{$row['customer_email']}|</td><td>{$row['customer_password']}</td><td>{$row['customer_phone']}</td><td>{$row['customer_city']}</td><tr>";
		 
			
		}
		echo"</table>";
		}
		?>
		
		<br><h3>SEARCH CUSTOMERS</h3>
		<form method ="post">
		<label>Enter Customer ID:</label>
		<input type="text" name="cust_ids" placeholder="Customer ID"/>
		<label>Enter Customer Name:</label>
		<input type="text" name="cust_name" placeholder="Customer Name"/>
		<label>Enter Customer Email:</label>
		<input type="text" name="cust_email" placeholder="Customer Email"/>
		<label>Enter Customer Phone:</label>
		<input type="number" name="cust_phone" placeholder="Customer Phone"/><br> <br>
		<label>Enter Customer City:</label>
		<input type="text" name="cust_city" placeholder="Customer City"/>
		<button type="submit" name="searchCustomer" value="Search Customers"class="btn btn-primary"> Search Customer </button>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['cust_ids']) || isset($_POST['cust_name']) || isset($_POST['cust_email']) || isset($_POST['cust_phone']) || isset($_POST['cust_city'])){
			function validate($entry){
			$entry=trim($entry);
			$entry=stripslashes($entry);
			$entry=htmlspecialchars($entry);
			return $entry;
			}		
	
		$id=validate($_POST['cust_ids']);
		$name=validate($_POST['cust_name']);
		$email=validate($_POST['cust_email']);
		$phone=validate($_POST['cust_phone']);
		$city=validate($_POST['cust_city']);
	
		if(empty($id) && empty($name) && empty($email) && empty($phone) && empty($city)) {
			echo "<script>
            alert('Customer Information not found. Please Re-enter');
            </script>";
			header("refresh:0");
						exit();
		}	
		$query = "SELECT * FROM customer WHERE 1";//customer_id='$id' OR customer_name='$name' OR customer_email='$email' OR customer_phone='$phone' OR customer_city='$city'";
		if(!empty($id)){
		$query.=" AND customer_id='$id'";
		}
		if(!empty($name)){
		$query.=" AND customer_name='$name'";
		}
		if(!empty($email)){
		$query.=" AND customer_email='$email'";
		}
		if(!empty($phone)){
		$query.=" AND customer_phone='$phone'";
	    }
		if(!empty($city)){
		$query.=" AND customer_city='$city'";
	    }
		$result= mysqli_query($conn, $query);
		//echo mysqli_num_rows($result);
		if(mysqli_num_rows($result)== 0){  
			echo "<script>
            alert('Customer Data Incorrect Please Check Your Inputs.');
            </script>";
			header("refresh:0");
			exit();
	    }
		echo "<table border='1'>";
		echo "<tr><td>CustomerID</td><td>Name</td><td>Email</td><td>Password</td><td>Phone</td><td>City</td><tr>";
		while($row = mysqli_fetch_assoc($result))
		{
		  
		   echo "<tr><td>{$row['customer_id']}</td><td>{$row['customer_name']}</td><td>{$row['customer_email']}|</td><td>{$row['customer_password']}</td><td>{$row['customer_phone']}</td><td>{$row['customer_city']}</td><tr>";
		 
			
		}
		echo"</table>";
		}
		?>
	
		<br><h3>DELETE CUSTOMERS</h3>
		<form method ="post">
		<label>Enter Customer ID:</label>
		<input type="text" name="cust_idd" placeholder="Customer ID"/>
		<button type="submit" name="deleteCustomer" value="Delete Customer" class="btn btn-primary"> Delete Customer </button>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['cust_idd'])){
			function validate($entry){
			$entry=trim($entry);
			$entry=stripslashes($entry);
			$entry=htmlspecialchars($entry);
			return $entry;
			}		
				
	
		$id=validate($_POST['cust_idd']);
	
		if(empty($id)) {
			echo "<script>
            alert('Customer ID Required.');
            </script>";
			header("refresh:0");
						exit();
		}
		
		$sqle="SELECT * FROM customer WHERE customer_id='$id'";
		$resulte=mysqli_query($conn,$sqle);
		if(mysqli_num_rows($resulte)== 0){
			echo "<script>
            alert('Customer not found.');
            </script>";
			header("refresh:0");
						exit();
	    }
		
		$sql="DELETE FROM customer WHERE customer_id='$id'";
		$result=mysqli_query($conn,$sql);
		$sql2="SELECT * FROM customer WHERE customer_id='$id'";
		$result2=mysqli_query($conn,$sql2);
		if(mysqli_num_rows($result2)== 0){
			//$row = mysqli_fetch_assoc($result3);
			//$_SESSION['name'] = $row['customer_name'];  
			echo "<script>
            alert('Deletion Successful.');
            </script>";
			header("Refresh:0");
			exit();
	    }
		}
		?>
</body>
</html>	