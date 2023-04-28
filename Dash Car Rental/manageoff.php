<!DOCTYPE html>
<html>
	<head>
		<title>MANAGE OFFICES</title>
		<link rel="stylesheet" href="styleadmin.css">
	</head>
<body>
		<div class="topnav">
 		<a href=advsearch.php>Advanced Search</a>
 		<a href=manageres.php> Manage Resrvations</a>
  		<a href=managecar.php>Manage Cars</a>
 		<a href=managecust.php>Manage Customers</a>
		<a href=managepay.php>Manage Payments</a>
		<a class="active" href=manageoff.php>Manage Offices</a>
		<a class="logout" href=index.php>logout</a>
		</div>
		
		<h3>VIEW ALL OFFICES</h3>
		<form method ="post">
		<button type="submit" name="viewOffice" value="View Offices"class="btn btn-primary">View Offices </button>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['viewOffice'])){
		$query = "SELECT * FROM office";
		$result= mysqli_query($conn, $query);
		echo "<table border='1'>";
		echo "<tr><td>OfficeID</td><td>OfficeCity</td><tr>";
		while($row = mysqli_fetch_assoc($result))
		{
		   
		   echo "<tr><td>{$row['office_id']}</td><td>{$row['office_city']}</td><tr>";
		  
			
		}
		echo"</table>";
		}
		?>
		
		<br><h3>SEARCH OFFICES</h3>
		<form method ="post">
		<label>Enter Office ID:</label>
		<input type="text" name="off_ids" placeholder="Office ID"/>
		<label>Enter Office City:</label>
		<input type="text" name="off_citys" placeholder="Office City"/>
		<button type="submit" name="searchOffice" value="Search Offices"class="btn btn-primary">Search office </button>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['off_ids']) || isset($_POST['off_citys'])){
			function validate($entry){
			$entry=trim($entry);
			$entry=stripslashes($entry);
			$entry=htmlspecialchars($entry);
			return $entry;
			}		
	
		$id=validate($_POST['off_ids']);
		$city=validate($_POST['off_citys']);
	
		if(empty($id) && empty($city)) {
			//header("Location: manageoff.php?error=Office ID or city required.");
			//exit();
	
			//header("Refresh:0");
			echo "<script>
            alert('Office ID or city required.');
            </script>";
						header("Refresh:0");
			exit();
		}	
		$query = "SELECT * FROM office WHERE 1"; //office_city='$city' OR office_id='$id'";
		if(!empty($id)){
			$query.=" AND office_id='$id'";
		}
		if(!empty($city)){
			$query.=" AND office_city='$city'";
			}
		$result= mysqli_query($conn, $query);
		//echo mysqli_num_rows($result);
		if(mysqli_num_rows($result)== 0){  
			//header("Location: manageoff.php?error=Office not found.");
			//exit();
			echo "<script>
            alert('Office not found.');
            </script>";
						header("Refresh:0");
			exit();
				
			
	    }
		echo "<table border='1'>";
		echo "<tr><td>OfficeID</td><td>OfficeCity</td><tr>";
		while($row = mysqli_fetch_assoc($result))
		{
		   
		   echo "<tr><td>{$row['office_id']}</td><td>{$row['office_city']}</td><tr>";
		  
			
		}
		echo"</table>";
		}
		?>
		
		<h3>ADD OFFICES</h3>
		<form method ="post">
		<label>Enter Office ID:</label>
		<input type="text" name="off_ida" placeholder="Office ID"/>
		<label>Enter Office City:</label>
		<input type="text" name="off_citya" placeholder="Office City"/>
		<button type="submit" name="addNewOffice" value="Add New Office" class="btn btn-primary"> Add Office </button>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['off_ida']) && isset($_POST['off_citya'])){	
			function validate($entry){
			$entry=trim($entry);
			$entry=stripslashes($entry);
			$entry=htmlspecialchars($entry);
			return $entry;
			}				
	
		$id=validate($_POST['off_ida']);
		$city=validate($_POST['off_citya']);
	
		if(empty($id) && empty($city)) {
			//header("Location: manageoff.php?error=Office ID and city required.");
			//exit();
						echo "<script>
            alert('Office ID and city required.');
            </script>";
			header("Refresh:0");
			exit();	
		}

		if(empty($city)) {
			//header("Location: manageoff.php?error=Office City required.");
			//exit();
						echo "<script>
            alert('Office City Required.');
            </script>";
						header("Refresh:0");
			exit();	
		}
		
		if(empty($id)) {
			//header("Location: manageoff.php?error=Office ID required.");
			//exit();
			echo "<script>
            alert('Office ID required.');
            </script>";
						header("Refresh:0");
			exit();	
		}
		
		$sql="INSERT INTO office(office_id,office_city) VALUES('$id','$city')";
		$result=mysqli_query($conn,$sql);
		$sql2="SELECT * FROM office WHERE office_id='$id' AND office_city='$city'";
		$result2=mysqli_query($conn,$sql2);
		if(mysqli_num_rows($result2)== 1){
			//$row = mysqli_fetch_assoc($result3);
			//$_SESSION['name'] = $row['customer_name'];  
			//echo 'Office added successfully'; //remember echo makes delete disappear
			//header("Location: userhome.php");
			//exit();
			echo "<script>
            alert('Office Added Successfully.');
            </script>";
						header("Refresh:0");
						exit();
	    }
		}
		?>
		
		<h3>DELETE OFFICES</h3>
		<form method ="post">
		<label>Enter Office ID:</label>
		<input type="text" name="off_idd" placeholder="Office ID"/>
		<button type="submit" name="deleteOffice" value="Delete Office" class="btn btn-primary"> Delete Office </button>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['off_idd'])){
			function validate($entry){
			$entry=trim($entry);
			$entry=stripslashes($entry);
			$entry=htmlspecialchars($entry);
			return $entry;
			}		
				
	
		$id=validate($_POST['off_idd']);
	
		if(empty($id)) {
			//header("Location: manageoff.php?error=Office ID required.");
			//exit();
			echo "<script>
            alert('Office ID required.');
            </script>";
						header("Refresh:0");
			exit();	
		}
		
		$sqle="SELECT * FROM office WHERE office_id='$id'";
		$resulte=mysqli_query($conn,$sqle);
		if(mysqli_num_rows($resulte)== 0){
		//header("Location: manageoff.php?error=Office not found.");
		//exit();
		echo "<script>
        alert('Office not found.');
        </script>";
					header("Refresh:0");
		exit();	
	    }
		$sql="DELETE FROM office WHERE office_id='$id'";
		$result=mysqli_query($conn,$sql);
		$sql2="SELECT * FROM office WHERE office_id='$id'";
		$result2=mysqli_query($conn,$sql2);
		if(mysqli_num_rows($result2)== 0){
			echo "<script>
            alert('Deletion Successful.');
            </script>";
			//echo 'Office deleted successfully';
						header("Refresh:0");
			exit();
	    }
		}
		?>
</body>
</html>	