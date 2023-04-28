<!DOCTYPE html>
<html>
	<head>
		<title>MANAGE PAYMENTS</title>
		<link rel="stylesheet" href="styleadmin.css">
	</head>
<body>
		<div class="topnav">
 		<a href=advsearch.php>Advanced Search</a>
 		<a href=manageres.php> Manage Resrvations</a>
  		<a href=managecar.php>Manage Cars</a>
 		<a href=managecust.php>Manage Customers</a>
		<a class="active" href=managepay.php>Manage Payments</a>
		<a href=manageoff.php>Manage Offices</a>
		<a class="logout" href=index.php>logout</a>
		</div>
		<div class="Managepayments">
		<h2>MANAGE PAYMENTS</h2>
		<h3>VIEW ALL PAYMENTS</h3>
		<form method ="post">
		<input type="submit" name="viewPayment" value="View Payments">
		</form>
		</div>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['viewPayment'])){
		$query = "SELECT reservation.customer_id,reservation.reservation_id,reservation.reservation_payment,reservation.reservation_date FROM reservation";
		$result= mysqli_query($conn, $query);
		echo "<table border='1'>";
		echo "<tr><td>CustomerID</td><td>ReservationID</td><td>Payment</td><td>ReservationDate</td><tr>";
		while($row = mysqli_fetch_assoc($result))
		{
		   //reservation.reservation_id
		   echo "<tr><td>{$row['customer_id']}</td><td>{$row['reservation_id']}</td><td>{$row['reservation_payment']}</td><td>{$row['reservation_date']}</td><tr>";
		   // echo '<pre>';
			//print_r($record);
			//echo '</pre>';
			
		}
		echo"</table>";
		}
		?>
		<div class="ManageBox">
		<h3>SEARCH PAYMENTS BY DATE</h3>
		<form method ="post">
		<label>Enter Starting Date:</label>
		<div class="sd-res">
		<input type="date" name="st_date" placeholder="Start Date"/></br>
		</div>
		<label>Enter Ending Date:</label>
		<div class="ed-res">
		<input type="date" name="ed_date" placeholder="End Date"/><br><br>
		<button type="submit" name="searchPayments" value="Search Payments" class="btn btn-primary"> Search Payment </button>
		</div>
	</form>
		</div>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['st_date']) || isset($_POST['ed_date'])){
			function validate($entry){
			$entry=trim($entry);
			$entry=stripslashes($entry);
			$entry=htmlspecialchars($entry);
			return $entry;
			}		
	
		$st=validate($_POST['st_date']);
		$ed=validate($_POST['ed_date']);
	
		if(empty($st) && empty($ed)) {
			//header("Location: managepay.php?error=Start or end date required.");
			//exit();
						echo "<script>
            alert('Start and end date required.');
            </script>";
						header("Refresh:0");
						exit();
		}

		$query = "SELECT reservation.customer_id,reservation.reservation_id,reservation.reservation_payment,reservation.reservation_date FROM reservation WHERE 1";//payment_date<'$ed' AND payment_date>'$st';";
		if(!empty($st)) {
		$query.=" AND reservation_date>'$st'";
		}
		if(!empty($ed)) {
		$query.=" AND reservation_date<'$ed'";
		}
		$result= mysqli_query($conn, $query);
		//echo mysqli_num_rows($result);
		if(mysqli_num_rows($result)== 0){  
			//header("Location: managepay.php?error=Payments not found.");
			//exit();
						echo "<script>
            alert('Payments not found.');
            </script>";
						header("Refresh:0");
						exit();
	    }
		echo "<table border='1'>";
		echo "<tr><td>CustomerID</td><td>ReservationID</td><td>Payment</td><td>ReservationDate</td><tr>";
		while($row = mysqli_fetch_assoc($result))
		{
		   //reservation.reservation_id
		   echo "<tr><td>{$row['customer_id']}</td><td>{$row['reservation_id']}</td><td>{$row['reservation_payment']}</td><td>{$row['reservation_date']}</td><tr>";
		   // echo '<pre>';
			//print_r($record);
			//echo '</pre>';
			
		}
		echo"</table>";
		}
		?>
</body>
</html>	