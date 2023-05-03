	<!DOCTYPE html>
<html>
	<head>
		<title>ADVANCED SEARCH</title>
		<link rel="stylesheet" href="styleadmin.css">
	</head>
	<script>
  function validateForm() {
    let x = document.forms["AdvForm"]["cust_idv"].value;
    let y = document.forms["AdvForm"]["cust_namev"].value;
	let z = document.forms["AdvForm"]["cust_emailv"].value;
	let a = document.forms["AdvForm"]["cust_phonev"].value;
	let b = document.forms["AdvForm"]["cust_cityv"].value;
	let c = document.forms["AdvForm"]["plate_idv"].value;
	let d = document.forms["AdvForm"]["car_makev"].value;
	let e = document.forms["AdvForm"]["car_modv"].value;
	let f = document.forms["AdvForm"]["car_yearv"].value;
	let g = document.forms["AdvForm"]["res_idv"].value;
	let h = document.forms["AdvForm"]["off_idv"].value;
	let k = document.forms["AdvForm"]["res_payv"].value;
	let l = document.forms["AdvForm"]["res_datev"].value;
	let m = document.forms["AdvForm"]["pk_datev"].value;
	let n = document.forms["AdvForm"]["r_datev"].value;
	if (x == "" && y== "" && a == "" && b== "" && c== "" && d == "" && e== "" && f== "" && g=="" && h=="" && k=="" && l== "" && m=="" && n=="") {
      alert("Please fill out all required fields.");
      return false;
    }
    
  }
  </script>
<body>
		<div class="topnav">
 		<a class="active" href=advsearch.php>Advanced Search</a>
 		<a href=manageres.php> Manage Resrvations</a>
  		<a href=managecar.php>Manage Cars</a>
 		<a href=managecust.php>Manage Customers</a>
		<a href=managepay.php>Manage Payments</a>
		<a href=manageoff.php>Manage Offices</a>
		<a class="logout" href=index.php>logout</a>
		</div>
		<div class="AdvSearchBox">
		<h3>ADVANCED SEARCH</h3>
		<form name="AdvForm" onsubmit="return validateForm()" method ="post">
		<h4>Customer Information</h4>
		<label>Enter Customer ID:</label>
		<input type="text" name="cust_idv" placeholder="Customer ID"/></br>
		<label>Enter Customer Name:</label>
		<input type="text" name="cust_namev" placeholder="Customer Name"/></br>
		<label>Enter Customer Email:</label>
		<input type="email" name="cust_emailv" placeholder="Customer Email"/></br>
		<label>Enter Customer Phone:</label>
		<input type="text" name="cust_phonev" placeholder="Customer Phone"/></br>
		<label>Enter Customer City:</label>
		<input type="text" name="cust_cityv" placeholder="Customer City"/>
		<h4>Car Information</h4>
				<label>Enter Car Plate ID:</label>
		<input type="text" name="plate_idv" placeholder="Plate ID"/></br>
				<label>Enter Car Make:</label>
		<input type="text" name="car_makev" placeholder="Car Make"/></br>
				<label>Enter Car Model:</label>
		<input type="text" name="car_modv" placeholder="Car Model"/></br>
				<label>Enter Car Year:</label>
		<input type="text" name="car_yearv" placeholder="Car Year"/></br>
		<h4>Reservation Information</h4>
				<label>Enter Reservation ID:</label>
		<input type="text" name="res_idv" placeholder="Reservation ID"/></br>
				<label>Enter Office ID:</label>
		<input type="text" name="off_idv" placeholder="Office ID"/></br>
				<label>Enter Reservation Payment:</label>
		<input type="text" name="res_payv" placeholder="Reservation Payment"/></br>
				<label>Enter Reservation Date:</label>
		<input type="date" name="res_datev" placeholder="Reservation Date"/></br>
				<label>Enter Reservation  Pickup Date:</label>
		<input type="date" name="pk_datev" placeholder="Pickup Date"/><br>
				<label>Enter Reservation Return Date:</label>
		<input type="date" name="r_datev" placeholder="Return Date"/>
		<p><tr><center><button type="submit" name="searchv" value="Search" class="btn btn-primary"> Search </button><center>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['cust_idv']) || isset($_POST['cust_namev']) 
		|| isset($_POST['cust_emailv']) || isset($_POST['cust_phonev']) 
		|| isset($_POST['cust_cityv']) || isset($_POST['plate_idv']) 
		|| isset($_POST['car_makev']) || isset($_POST['car_modv']) 
		|| isset($_POST['car_yearv']) || isset($_POST['res_idv']) 
		|| isset($_POST['off_idv']) || isset($_POST['res_payv']) 
		|| isset($_POST['res_datev']) || isset($_POST['pk_datev']) 
		|| isset($_POST['r_datev'])){
			function validate($entry){
			$entry=trim($entry);
			$entry=stripslashes($entry);
			$entry=htmlspecialchars($entry);
			return $entry;
			}		
	
		$cid=validate($_POST['cust_idv']);
		$cnm=validate($_POST['cust_namev']);
		$cem=validate($_POST['cust_emailv']);
		$cph=validate($_POST['cust_phonev']);
		$cct=validate($_POST['cust_cityv']);
		$pid=validate($_POST['plate_idv']);
		$cmk=validate($_POST['car_makev']);
		$cmd=validate($_POST['car_modv']);
		$cyr=validate($_POST['car_yearv']);
		$rid=validate($_POST['res_idv']);
		$oid=validate($_POST['off_idv']);
		$rpy=validate($_POST['res_payv']);
		$rdt=validate($_POST['res_datev']);
	    $pkd=validate($_POST['pk_datev']);
		$rrtd=validate($_POST['r_datev']);
	
		if(empty($cid) && empty($cnm) 
		&& empty($cem) && empty($cph) 
		&& empty($cct) && empty($pid) 
		&& empty($cmk) && empty($cmd)
		&& empty($cyr) && empty($rid)
		&& empty($oid) && empty($rpy)
		&& empty($rdt) && empty($pkd)
		&& empty($rrtd)) {
					echo "<script>
            alert('Please enter search information.');
            </script>";
						header("Refresh:0");
						exit();
		}
		
		$queryl = "(SELECT reservation.reservation_id,reservation.reservation_date,reservation.reservation_pickup_date,reservation.reservation_return_date,
		reservation.reservation_payment,reservation.office_id,customer.customer_id,customer.customer_name,customer.customer_email,
		customer.customer_phone,customer.customer_city,car.car_plate_id,car.car_make,car.car_model,car.car_year FROM car
		LEFT JOIN reservation ON reservation.car_plate_id=car.car_plate_id
		LEFT JOIN customer ON reservation.customer_id=customer.customer_id WHERE 1" ;

		if(!empty($cid)){
		$queryl.=" AND customer.customer_id='$cid'";
		}
		if(!empty($cnm)){
		$queryl.=" AND customer.customer_name='$cnm'";
		}
		if(!empty($cem)){
		$queryl.=" AND customer.customer_email='$cem'";
		}
		if(!empty($cph)){
		$queryl.=" AND customer.customer_phone='$cph'";
	    }
		if(!empty($cct)){
		$queryl.=" AND customer.customer_city='$cct'";
		}
		if(!empty($pid)){
		$queryl.=" AND car.car_plate_id='$pid'";
		}
		if(!empty($cmk)){
		$queryl.=" AND car.car_make='$cmk'";
		}
		if(!empty($cmd)){
		$queryl.=" AND car.car_model='$cmd'";
	    }
		if(!empty($cyr)){
		$queryl.=" AND car.car_year='$cyr'";
		}
		if(!empty($rid)){
		$queryl.=" AND reservation.reservation_id='$rid'";
		}
		if(!empty($oid)){
		$queryl.=" AND reservation.office_id='$oid'";
		}
		if(!empty($rpy)){
		$queryl.=" AND reservation.reservation_payment='$rpy'";
	    }
		if(!empty($rdt)){
		$queryl.=" AND reservation.reservation_date='$rdt'";
		}
		if(!empty($pkd)){
		$queryl.=" AND reservation.reservation_pickup_date='$pkd'";
		}
		if(!empty($rrtd)){
		$queryl.=" AND reservation.reservation_return_date='$rrtd'";
		}
        
		$queryl.=")";
		
		$queryr = "(SELECT reservation.reservation_id,reservation.reservation_date,reservation.reservation_pickup_date,reservation.reservation_return_date,
		reservation.reservation_payment,reservation.office_id,customer.customer_id,customer.customer_name,customer.customer_email,
		customer.customer_phone,customer.customer_city,car.car_plate_id,car.car_make,car.car_model,car.car_year FROM customer
		LEFT JOIN reservation ON reservation.customer_id=customer.customer_id
		LEFT JOIN car ON reservation.car_plate_id=car.car_plate_id
		WHERE 1";

		if(!empty($cid)){
		$queryr.=" AND customer.customer_id='$cid'";
		}
		if(!empty($cnm)){
		$queryr.=" AND customer.customer_name='$cnm'";
		}
		if(!empty($cem)){
		$queryr.=" AND customer.customer_email='$cem'";
		}
		if(!empty($cph)){
		$queryr.=" AND customer.customer_phone='$cph'";
	    }
		if(!empty($cct)){
		$queryr.=" AND customer.customer_city='$cct'";
		}
		if(!empty($pid)){
		$queryr.=" AND car.car_plate_id='$pid'";
		}
		if(!empty($cmk)){
		$queryr.=" AND car.car_make='$cmk'";
		}
		if(!empty($cmd)){
		$queryr.=" AND car.car_model='$cmd'";
	    }
		if(!empty($cyr)){
		$queryr.=" AND car.car_year='$cyr'";
		}
		if(!empty($rid)){
		$queryr.=" AND reservation.reservation_id='$rid'";
		}
		if(!empty($oid)){
		$queryr.=" AND reservation.office_id='$oid'";
		}
		if(!empty($rpy)){
		$queryr.=" AND reservation.reservation_payment='$rpy'";
	    }
		if(!empty($rdt)){
		$queryr.=" AND reservation.reservation_date='$rdt'";
		}
		if(!empty($pkd)){
		$queryr.=" AND reservation.reservation_pickup_date='$pkd'";
		}
		if(!empty($rrtd)){
		$queryr.=" AND reservation.reservation_return_date='$rrtd'";
		}
		
		$queryr.=")";
		
		$queryl.=" UNION ";
		$queryl.=$queryr;
		
		$result= mysqli_query($conn, $queryl);
		//echo mysqli_num_rows($result);
		if(mysqli_num_rows($result)== 0){  
			//header("Location: advsearch.php?error=Information not found.");
			//exit();
			echo "<script>
            alert('Information not found.');
            </script>";
						header("Refresh:0");
						exit();
	    }
		echo "<table border='1'>";
		echo "<tr><td>ReservationID</td><td>ReservationDate</td><td>PickupDate</td><td>ReturnDate</td><td>Payment</td><td>OfficeID</td><td>CustomerID</td><td>Name</td><td>Email</td><td>Phone</td><td>City</td><td>CarPlate|</td><td>CarMake</td><td>CarModel</td><td>CarYear</td><tr>";
		while($row = mysqli_fetch_assoc($result))
		{
		   
		   echo "<tr><td>{$row['reservation_id']}</td><td>{$row['reservation_date']}</td><td>{$row['reservation_pickup_date']}</td><td>{$row['reservation_return_date']}</td><td>{$row['reservation_payment']}</td><td>{$row['office_id']}</td><td>{$row['customer_id']}</td><td>{$row['customer_name']}</td><td>{$row['customer_email']}</td><td>{$row['customer_phone']}</td><td>{$row['customer_city']}</td><td>{$row['car_plate_id']}</td><td>{$row['car_make']}</td><td>{$row['car_model']}</td><td>{$row['car_year']}</td><tr>";
		   
			
		}
		echo"</table>";
		}
		?>	
		</div>
</body>
</html>	
		