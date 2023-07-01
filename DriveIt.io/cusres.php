<!DOCTYPE html>
<html>
	<head>
		<title>MANAGE RESERVATIONS</title>
		<link rel="stylesheet" href="styleuser.css">
	</head>
<body>
		<div class="topnav">
 		<a class="active" href=cusres.php> Manage Reservation</a>
		<a href=cuscar.php>Search Cars</a>
		<a class="logout" href=index.php>logout</a>
		</div>
		<div class="ManageResVV">
		<?php if (isset($_GET['error'])) { ?>
		<p class="error"><?php echo $_GET['error']; ?></p>
		<?php } ?>
		<br><h3>VIEW ALL MY RESERVATIONS</h3>
		<form method ="post">
		<button type="submit" name="viewRes" value="View Reservations" class="btn btn-primary"> View reservations</button>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		session_start();
		//echo 'Welcome, '.$_SESSION['ssid'].'.';
		//session_start();
		if(isset($_POST['viewRes'])){
			//echo 'Welcome, '.$_SESSION['ssid'].'.';
		$sid=$_SESSION['ssid'];
		$query = "SELECT reservation.reservation_id,reservation.reservation_date,reservation.reservation_pickup_date,reservation.reservation_return_date,
		reservation.reservation_payment,reservation.office_id,customer.customer_city,reservation.car_plate_id,car.car_make,car.car_model,car.car_year,car.car_price 
		FROM reservation 
		INNER JOIN customer ON reservation.customer_id=customer.customer_id
		INNER JOIN car ON reservation.car_plate_id=car.car_plate_id WHERE reservation.customer_id='$sid'";
		//INNER JOIN car_status ON car.car_plate_id=car_status.car_plate_id';
		$result= mysqli_query($conn, $query);
		echo "<table border='1'>";
		echo "<tr><td>ReservationID</td><td>ReservationDate</td><td>PickupDate</td><td>ReturnDate</td><td>Payment</td><td>OfficeID</td><td>City</td><td>CarPlate</td><td>CarMake</td><td>CarModel</td><td>CarYear</td><td>Price</td><tr>";
		while($row = mysqli_fetch_assoc($result))
		{
		   
		   echo "<tr><td>{$row['reservation_id']}</td><td>{$row['reservation_date']}</td><td>{$row['reservation_pickup_date']}</td><td>{$row['reservation_return_date']}</td><td>{$row['reservation_payment']}</td><td>{$row['office_id']}</td><td>{$row['customer_city']}|</td><td>{$row['car_plate_id']}</td><td>{$row['car_make']}</td><td>{$row['car_model']}</td><td>{$row['car_year']}</td><td>{$row['car_price']}</td><tr>";
		   
			
		}
		echo"</table>";
		}
		?>


		
		<br><h3>MAKE A RESERVATION</h3>
		<form method ="post">
		<label>Enter Car Plate ID:</label>
		<input type="text" name="plate_idr" placeholder="Plate ID"/>
		<label>Enter Pickup Date:</label>
		<input type="date" name="p_dater" placeholder="Pickup Date"/>
		<label>Enter Return Date:</label>
		<input type="date" name="r_dater" placeholder="Return Date"/><br><br>
		<button type="submit" name="searchResr" value="Make Reservation" class="btn btn-primary"> Make Reservation</button>
		</form>
	</div>
	<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if((isset($_POST['r_dater']) && isset($_POST['p_dater'])) && isset($_POST['plate_idr'])){ //&& isset($_POST['o_idr'])){
			function validate($entry){
			$entry=trim($entry);
			$entry=stripslashes($entry);
			$entry=htmlspecialchars($entry);
			return $entry;
			}		
	
		$pd=validate($_POST['p_dater']);
		$rd=validate($_POST['r_dater']);
		$id=validate($_POST['plate_idr']);
		//$of=validate($_POST['o_idr']);
		$sid=$_SESSION['ssid'];
		if(empty($pd) && empty($rd) && empty($id)) {
			//header("Location: cusres.php?error=Reservation information required.");
			//exit();
			echo "<script>
            alert('Reservation Information Required.');
            </script>";
						header("Refresh:0");
						exit();
		}

		if(empty($id)) {
			//header("Location: cusres.php?error=Car plate id required.");
			//exit();
						echo "<script>
            alert('Car plate id required.');
            </script>";
						header("Refresh:0");
						exit();
		}
		
		if(empty($rd)) {
			//header("Location: cusres.php?error=Return date required.");
			//exit();
						echo "<script>
            alert('Return date required.');
            </script>";
						header("Refresh:0");
						exit();
		}
		
		if(empty($pd)) {
			//header("Location: cusres.php?error=Pickup date required.");
			//exit();
			echo "<script>
            alert('Pickup date required.');
            </script>";
						header("Refresh:0");
						exit();
		}
		
		//if(empty($city)) {
		//	header("Location: cusres.php?error=City required.");
		//	exit();
		//}
		
		//$qre = "SELECT * FROM office WHERE office.office_id= '$of' ";
		//$re= mysqli_query($conn, $qre);
		//echo mysqli_num_rows($re);
		//if(mysqli_num_rows($re)== 0){  
		//	header("Location: cusres.php?error=Enter Valid Office ID.");
		//	exit();
	    //}
		
		$querye = "SELECT reservation.car_plate_id FROM reservation
		WHERE reservation.car_plate_id='$id' AND (reservation.reservation_return_date>'$pd' AND reservation.reservation_pickup_date<'$pd' 
		OR reservation.reservation_pickup_date<'$rd' AND reservation.reservation_return_date>'$rd')";
		//$querye = "SELECT reservation.car_plate_id FROM reservation WHERE reservation.car_plate_id='$id' AND (reservation_return_date>'$pd' OR reservation_pickup_date<'$rd')";
		$resulte= mysqli_query($conn, $querye);
		echo mysqli_num_rows($resulte);
		if(mysqli_num_rows($resulte)!= 0){  
			//header("Location: cusres.php?error=Car reserved for this period.");
			//exit();
			echo "<script>
            alert('Car reserved for this period.');
            </script>";
						header("Refresh:0");
						exit();
	    }
		$qp="SELECT car_price FROM car WHERE car_plate_id='$id'";
				$resultp=mysqli_query($conn,$qp);
		if(mysqli_num_rows($resultp)== 1){
			$rowp = mysqli_fetch_assoc($resultp);
			$price = $rowp['car_price'];  
	    }
		$pd2 = new DateTime($pd);
		$rd2 = new DateTime($rd);
		$dif = $pd2->diff($rd2)->format("%a");
		$payment=$dif*($price);
		$d=date('Y-m-d');
		//echo $sid;
		$qo="SELECT office_id FROM office WHERE office_city IN (SELECT customer_city FROM customer WHERE customer_id='$sid')";
		$resulto=mysqli_query($conn,$qo);
		if(mysqli_num_rows($resulto)== 0){
			//header("Location: cusres.php?error=No office in your city.");
			//exit(); 
			echo "<script>
            alert('No office in your city.');
            </script>";
						header("Refresh:0");
						exit();		
	    }
		else if(mysqli_num_rows($resulto)== 1){
			$rowo = mysqli_fetch_assoc($resulto);
			$of = $rowo['office_id'];  
	    }
		$sql="INSERT INTO reservation(customer_id,car_plate_id,reservation_date,office_id,reservation_payment,reservation_pickup_date,reservation_return_date)
		 VALUES ('$sid','$id','$d','$of','$payment','$pd','$rd')";
		$result=mysqli_query($conn,$sql);
		$sql2="SELECT * FROM reservation WHERE reservation.car_plate_id='$id' AND reservation.customer_id='$sid' AND reservation_date='$d' 
		AND reservation.office_id='$of' AND reservation_payment='$payment' AND reservation_pickup_date='$pd' AND reservation_return_date='$rd'";
		$result2=mysqli_query($conn,$sql2);
		if(mysqli_num_rows($result2)== 1){

			$rowx =  mysqli_fetch_assoc($result2);
			//echo 'Reservation successful. Your Payment due is ' .$rowx['reservation_payment'].'$'; //remember echo makes delete disappear
			//exit();
			//echo "<script>
            //alert('Reservation successful. Your Payment due is .$rowx['reservation_payment'].$');
            //</script>";
			echo '<script type="text/javascript">alert("Reservation Successful, your payment is '.$rowx['reservation_payment'].' $");</script>';
						header("Refresh:0");
						exit();
	    }
		}
		?>
</body>
</html>	