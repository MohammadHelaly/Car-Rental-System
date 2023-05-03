<!DOCTYPE html>
<html>
	<head>
		<title>MANAGE RESERVATIONS</title>
		<link rel="stylesheet" href="styleadmin.css">
	</head>
<body>
		<div class="topnav">
 		<a href=advsearch.php>Advanced Search</a>
 		<a class="active" href=manageres.php> Manage Resrvations</a>
  		<a href=managecar.php>Manage Cars</a>
 		<a href=managecust.php>Manage Customers</a>
		<a href=managepay.php>Manage Payments</a>
		<a href=manageoff.php>Manage Offices</a>
		<a class="logout" href=index.php>logout</a>
		</div>
		<div class="ManageRes">
		<h3>VIEW ALL RESERVATIONS</h3>
		<form method ="post">
		<button type="submit" name="viewRes" value="View Reservations" class="btn btn-primary"> View Reservations </button>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['viewRes'])){
		$query = "SELECT reservation.reservation_id,reservation.reservation_date,reservation.reservation_pickup_date,reservation.reservation_return_date,
		reservation.reservation_payment,reservation.office_id,reservation.customer_id,customer.customer_name,customer.customer_email,
		customer.customer_phone,customer.customer_city,reservation.car_plate_id,car.car_make,car.car_model,car.car_year FROM reservation 
		INNER JOIN customer ON reservation.customer_id=customer.customer_id
		INNER JOIN car ON reservation.car_plate_id=car.car_plate_id";
		//INNER JOIN car_status ON car.car_plate_id=car_status.car_plate_id';
		$result= mysqli_query($conn, $query);
		echo "<table border='1'>";
		echo "<tr><td>ReservationID</td><td>ReservationDate</td><td>PickupDate</td><td>ReturnDate</td><td>Payment</td><td>OfficeID</td><td>CustomerID</td><td>Email</td><td>Phone</td><td>City</td><td>CarPlate|</td><td>CarMake</td><td>CarModel</td><td>CarYear</td><tr>";
		while($row = mysqli_fetch_assoc($result))
		{
		   
		   echo "<tr><td>{$row['reservation_id']}</td><td>{$row['reservation_date']}</td><td>{$row['reservation_pickup_date']}</td><td>{$row['reservation_return_date']}</td><td>{$row['reservation_payment']}</td><td>{$row['office_id']}</td><td>{$row['customer_id']}</td><td>{$row['customer_email']}|</td><td>{$row['customer_phone']}</td><td>{$row['customer_city']}</td><td>{$row['car_plate_id']}</td><td>{$row['car_make']}</td><td>{$row['car_model']}</td><td>{$row['car_year']}</td><tr>";
		   
			
		}
		echo"</table>";
		}
		?>
		
		<h3>SEARCH RESERVATIONS BY DATE</h3>
		<form method ="post">
		<label>Enter Starting Date:</label>
		<input type="date" name="st_dated" placeholder="Start Date"/>
		<label>Enter Ending Date:</label>
		<input type="date" name="ed_dated" placeholder="End Date"/><br><br>
		<button type="submit" name="searchResd" value="Search Reservations" class="btn btn-primary"> Search Reservations </button>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['st_dated']) || isset($_POST['ed_dated'])){
			function validate($entry){
			$entry=trim($entry);
			$entry=stripslashes($entry);
			$entry=htmlspecialchars($entry);
			return $entry;
			}		
	
		$st=validate($_POST['st_dated']);
		$ed=validate($_POST['ed_dated']);
	
		if(empty($st) && empty($ed)) {
			//header("Location: manageres.php?error=Start or end date required.");
			//exit();
									echo "<script>
            alert('Start or end date required.');
            </script>";
						header("Refresh:0");
						exit();
		}

		$query = "SELECT reservation.reservation_id,reservation.reservation_date,reservation.reservation_pickup_date,reservation.reservation_return_date,
		reservation.reservation_payment,reservation.office_id,reservation.customer_id,customer.customer_name,customer.customer_email,
		customer.customer_phone,customer.customer_city,reservation.car_plate_id,car.car_make,car.car_model,car.car_year FROM reservation
		INNER JOIN customer ON reservation.customer_id=customer.customer_id
		INNER JOIN car ON reservation.car_plate_id=car.car_plate_id
		WHERE 1";//reservation.reservation_date<'$ed' AND reservation.reservation_date>'$st'";
		//INNER JOIN car_status ON car.car_plate_id=car_status.car_plate_id';
		
		if(!empty($st)) {
		$query.=" AND reservation.reservation_date>'$st'";
		}

		if(!empty($ed)) {
		$query.=" AND reservation.reservation_date<'$ed'";
		}
		
		
		$result= mysqli_query($conn, $query);
		if(mysqli_num_rows($result)== 0){  
			//header("Location: manageres.php?error=Reservations not found.");
			//exit();
									echo "<script>
            alert('Reservations not found.');
            </script>";
						header("Refresh:0");
						exit();
	    }
	echo "<table border='1'>";
		echo "<tr><td>ReservationID</td><td>ReservationDate</td><td>PickupDate</td><td>ReturnDate</td><td>Payment</td><td>OfficeID</td><td>CustomerID</td><td>Email</td><td>Phone</td><td>City</td><td>CarPlate|</td><td>CarMake</td><td>CarModel</td><td>CarYear</td><tr>";
		while($row = mysqli_fetch_assoc($result))
		{
		   
		   echo "<tr><td>{$row['reservation_id']}</td><td>{$row['reservation_date']}</td><td>{$row['reservation_pickup_date']}</td><td>{$row['reservation_return_date']}</td><td>{$row['reservation_payment']}</td><td>{$row['office_id']}</td><td>{$row['customer_id']}</td><td>{$row['customer_email']}|</td><td>{$row['customer_phone']}</td><td>{$row['customer_city']}</td><td>{$row['car_plate_id']}</td><td>{$row['car_make']}</td><td>{$row['car_model']}</td><td>{$row['car_year']}</td><tr>";
		   
			
		}
		echo"</table>";
		}
		?>
		
		
		<br><h3>SEARCH RESERVATIONS BY CAR/DATE</h3>
		<form method ="post">
		<label>Enter Car Plate ID:</label>
		<input type="text" name="plate_idr" placeholder="Plate ID"/>
		<label>Enter Starting Date:</label>
		<input type="date" name="st_dater" placeholder="Start Date"/>
		<label>Enter Ending Date:</label>
		<input type="date" name="ed_dater" placeholder="End Date"/><br><br>
		<button type="submit" name="searchResr" value="Search Reservations" class="btn btn-primary"> Search Reservations </button>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if((isset($_POST['st_dater']) || isset($_POST['ed_dater'])) && isset($_POST['plate_idr'])){
			function validate($entry){
			$entry=trim($entry);
			$entry=stripslashes($entry);
			$entry=htmlspecialchars($entry);
			return $entry;
			}		
	
		$st=validate($_POST['st_dater']);
		$ed=validate($_POST['ed_dater']);
		$id=validate($_POST['plate_idr']);
	
		if(empty($st) && empty($ed) && empty($id)) {
			//header("Location: manageres.php?error=Search information required.");
			//exit();
									echo "<script>
            alert('Search information required.');
            </script>";
						header("Refresh:0");
						exit();
		}

		if(empty($id)) {
			//header("Location: manageres.php?error=Car plate id required.");
			//exit();
									echo "<script>
            alert('Car plate ID required.');
            </script>";
						header("Refresh:0");
						exit();
		}

		//if(empty($st)) {
		//	header("Location: manageres.php?error=Start date required.");
		//	exit();
		//}


		//if(empty($ed)) {
		//	header("Location: manageres.php?error=End date required.");
		//	exit();
		//}
		
		//$query = "SELECT reservation.reservation_id,reservation.reservation_date,reservation.reservation_pickup_date,reservation.reservation_return_date,
		//reservation.reservation_payment,reservation.office_id,reservation.car_plate_id,car.car_make,car.car_model,car.car_year FROM reservation 
		//INNER JOIN customer ON reservation.customer_id=customer.customer_id
		//INNER JOIN car ON reservation.car_plate_id=car.car_plate_id
		//WHERE car.car_plate_id='$id'";// reservation.reservation_date<'$ed' AND reservation.reservation_date>'$st' AND 
		//INNER JOIN car_status ON car.car_plate_id=car_status.car_plate_id';
		
		$query = "SELECT reservation.reservation_id,reservation.reservation_date,reservation.reservation_pickup_date,reservation.reservation_return_date,
		reservation.reservation_payment,reservation.office_id,reservation.customer_id,customer.customer_name,customer.customer_email,
		customer.customer_phone,customer.customer_city,reservation.car_plate_id,car.car_make,car.car_model,car.car_year FROM reservation
		INNER JOIN car ON reservation.car_plate_id=car.car_plate_id
		INNER JOIN customer ON reservation.customer_id=customer.customer_id
		WHERE car.car_plate_id='$id'";
				
		if(!empty($st)) {
		$query.=" AND reservation.reservation_date>'$st'";
		}

		if(!empty($ed)) {
		$query.=" AND reservation.reservation_date<'$ed'";
		}
		
		
		$result= mysqli_query($conn, $query);
		if(mysqli_num_rows($result)== 0){  
			//header("Location: manageres.php?error=Reservations not found.");
			//exit();
									echo "<script>
            alert('Reservations not found.');
            </script>";
						header("Refresh:0");
						exit();
	    }
		echo "<table border='1'>";
		echo "<tr><td>ReservationID</td><td>ReservationDate</td><td>PickupDate</td><td>ReturnDate</td><td>Payment</td><td>OfficeID</td><td>CustomerID</td><td>Email</td><td>Phone</td><td>City</td><td>CarPlate|</td><td>CarMake</td><td>CarModel</td><td>CarYear</td><tr>";
		while($row = mysqli_fetch_assoc($result))
		{
		   
		   echo "<tr><td>{$row['reservation_id']}</td><td>{$row['reservation_date']}</td><td>{$row['reservation_pickup_date']}</td><td>{$row['reservation_return_date']}</td><td>{$row['reservation_payment']}</td><td>{$row['office_id']}</td><td>{$row['customer_id']}</td><td>{$row['customer_email']}|</td><td>{$row['customer_phone']}</td><td>{$row['customer_city']}</td><td>{$row['car_plate_id']}</td><td>{$row['car_make']}</td><td>{$row['car_model']}</td><td>{$row['car_year']}</td><tr>";
		   
			
		}
		echo"</table>";
		}
		?>

		<h3>SEARCH RESERVATIONS BY CUSTOMER/DATE</h3>
		<form method ="post">
		<label>Enter Customer ID:</label>
		<input type="text" name="cust_idc" placeholder="Customer ID"/>
		<label>Enter Starting Date:</label>
		<input type="date" name="st_datec" placeholder="Start Date"/>
		<label>Enter Ending Date:</label>
		<input type="date" name="ed_datec" placeholder="End Date"/><br><br>
		<button type="submit" name="searchResc" value="Search Reservations" class="btn btn-primary"> Search Reservations </button>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if((isset($_POST['st_datec']) || isset($_POST['ed_datec'])) && isset($_POST['cust_idc'])){
			function validate($entry){
			$entry=trim($entry);
			$entry=stripslashes($entry);
			$entry=htmlspecialchars($entry);
			return $entry;
			}		
	
		$st=validate($_POST['st_datec']);
		$ed=validate($_POST['ed_datec']);
		$id=validate($_POST['cust_idc']);
	
		if(empty($st) && empty($ed) && empty($id)) {
			//header("Location: manageres.php?error=Search information required.");
			//exit();
									echo "<script>
            alert('Search information required.');
            </script>";
						header("Refresh:0");
						exit();
		}

		//if(empty($st)) {
		//	header("Location: manageres.php?error=Start date required.");
		//	exit();
		//}

		if(empty($id)) {
			//header("Location: manageres.php?error=Customer id required.");
			//exit();
									echo "<script>
            alert('Customer ID required.');
            </script>";
						header("Refresh:0");
						exit();
		}

		//if(empty($ed)) {
		//	header("Location: manageres.php?error=End date required.");
		//	exit();
		//}
		
		$query = "SELECT reservation.reservation_id,reservation.reservation_date,reservation.reservation_pickup_date,reservation.reservation_return_date,
		reservation.reservation_payment,reservation.office_id,reservation.customer_id,customer.customer_name,customer.customer_email,
		customer.customer_phone,customer.customer_city,reservation.car_plate_id,car.car_make,car.car_model,car.car_year FROM reservation
		INNER JOIN customer ON reservation.customer_id=customer.customer_id
		INNER JOIN car ON reservation.car_plate_id=car.car_plate_id
		WHERE customer.customer_id='$id'";//reservation.reservation_date<'$ed' AND reservation.reservation_date>'$st' AND 
		//INNER JOIN car_status ON car.car_plate_id=car_status.car_plate_id';
						
		if(!empty($st)) {
		$query.=" AND reservation.reservation_date>'$st'";
		}

		if(!empty($ed)) {
		$query.=" AND reservation.reservation_date<'$ed'";
		}
		
		
		$result= mysqli_query($conn, $query);
		if(mysqli_num_rows($result)== 0){  
			//header("Location: manageres.php?error=Reservations not found.");
			//exit();
						echo "<script>
            alert('Reservations not found.');
            </script>";
						header("Refresh:0");
						exit();
	    }
		echo "<table border='1'>";
		echo "<tr><td>ReservationID</td><td>ReservationDate</td><td>PickupDate</td><td>ReturnDate</td><td>Payment</td><td>OfficeID</td><td>CustomerID</td><td>Email</td><td>Phone</td><td>City</td><td>CarPlate|</td><td>CarMake</td><td>CarModel</td><td>CarYear</td><tr>";
		while($row = mysqli_fetch_assoc($result))
		{
		   
		   echo "<tr><td>{$row['reservation_id']}</td><td>{$row['reservation_date']}</td><td>{$row['reservation_pickup_date']}</td><td>{$row['reservation_return_date']}</td><td>{$row['reservation_payment']}</td><td>{$row['office_id']}</td><td>{$row['customer_id']}</td><td>{$row['customer_email']}|</td><td>{$row['customer_phone']}</td><td>{$row['customer_city']}</td><td>{$row['car_plate_id']}</td><td>{$row['car_make']}</td><td>{$row['car_model']}</td><td>{$row['car_year']}</td><tr>";
		   
			
		}
		echo"</table>";
		}
		?>
		
				<br><h3>DELETE RESERVATIONS</h3>
		<form method ="post">
		<label>Enter Reservation ID:</label>
		<input type="text" name="res_idd" placeholder="Reservation ID"/><br> <br>
		<button type="submit" name="deleteRes" value="Delete Reservation" class="btn btn-primary"> Delete Reservations </button>
		</form>
	</div>
	<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['res_idd'])){
			function validate($entry){
			$entry=trim($entry);
			$entry=stripslashes($entry);
			$entry=htmlspecialchars($entry);
			return $entry;
			}		
				
	
		$id=validate($_POST['res_idd']);
	
		if(empty($id)) {
			//header("Location: manageres.php?error=Reservation ID required.");
			//exit();
						echo "<script>
            alert('Reservation ID required.');
            </script>";
						header("Refresh:0");
						exit();
		}
		
		$sqle="SELECT * FROM reservation WHERE reservation_id='$id'";
		$resulte=mysqli_query($conn,$sqle);
		if(mysqli_num_rows($resulte)== 0){  
			//header("Location: manageres.php?error=Reservation not found.");
			//exit();
						echo "<script>
            alert('Reservation not found.');
            </script>";
						header("Refresh:0");
						exit();
	    }
		
		$sql="DELETE FROM reservation WHERE reservation_id='$id'";
		$result=mysqli_query($conn,$sql);
		$sql2="SELECT * FROM reservation WHERE reservation_id='$id'";
		$result2=mysqli_query($conn,$sql2);
		if(mysqli_num_rows($result2)== 0){
			//$row = mysqli_fetch_assoc($result3);
			//$_SESSION['name'] = $row['customer_name'];  
			//echo 'Reservation deleted successfully';
			//header("Location: userhome.php");
			//exit();
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