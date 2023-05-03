<!DOCTYPE html>
<html>
	<head>
		<title>SEARCH CARS</title>
		<link rel="stylesheet" href="Styleuser.css">
	</head>
<body>
		<div class="topnav">
 		<a href=cusres.php> Manage Reservation</a>
		<a class="active" href=cuscar.php>Search Cars</a>
		<a class="logout" href=index.php>logout</a>
		</div>
		<div class="searchCARS">
		
		<?php if (isset($_GET['error'])) { ?>
		<p class="error"><?php echo $_GET['error']; ?></p>
		<?php } ?>
		<h3>VIEW ALL CARS</h3>
		<form method ="post">
		<button type="submit" name="viewCar" value="View Cars" class="btn btn-primary"> View Cars </button>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['viewCar'])){
		$query = "SELECT * FROM car";
		$result= mysqli_query($conn, $query);
		echo "<table border='1'>";
		echo "<tr><td>CarPlate</td><td>CarMake</td><td>CarModel</td><td>Price</td><td>CarYear</td><tr>";
		while($row = mysqli_fetch_assoc($result))
		{
		   
		   echo "<tr><td>{$row['car_plate_id']}</td><td>{$row['car_make']}</td><td>{$row['car_model']}</td><td>{$row['car_price']}</td><td>{$row['car_year']}</td><tr>";
		  
		}
		echo"</table>";
		}
		?>
		
		 <br> <h3>SEARCH CARS</h3>
		<form method ="post">
		<label>Enter Car Plate ID:</label>
		<input type="text" name="plate_ids" placeholder="Plate ID"/>
		<label>Enter Car Make:</label>
		<input type="text" name="car_makes" placeholder="Car Make"/>
		<label>Enter Car Model:</label>
		<input type="text" name="car_mods" placeholder="Car Model"/>
		<label>Enter Car Year:</label>
		<input type="text" name="car_years" placeholder="Car Year"/> <br><br>
		<label>Enter Car Price:</label>
		<input type="text" name="car_prices" placeholder="Car Price"/>
		<button type="submit" name="searchCars" value="Search Cars" class="btn btn-primary"> Search cars</button><br>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['plate_ids']) || isset($_POST['car_makes']) || isset($_POST['car_mods']) || isset($_POST['car_years']) || isset($_POST['car_prices'])){
			function validate($entry){
			$entry=trim($entry);
			$entry=stripslashes($entry);
			$entry=htmlspecialchars($entry);
			return $entry;
			}		
	
		$id=validate($_POST['plate_ids']);
		$make=validate($_POST['car_makes']);
		$model=validate($_POST['car_mods']);
		$year=validate($_POST['car_years']);
		$price=validate($_POST['car_prices']);
			
		if(empty($id) && empty($make) && empty($model) && empty($year) && empty($price)) {
			//header("Location: cuscar.php?error=Car information required.");
			//exit();
			echo "<script>
            alert('Car information required.');
            </script>";
						header("Refresh:0");
						exit();	
		}	
		$query = "SELECT * FROM car WHERE 1";//car_plate_id='$id' OR car_make='$make' OR car_model='$model' OR car_year='$year'";
		if(!empty($id)){
		$query.=" AND car_plate_id='$id'";
		}
		if(!empty($make)){
		$query.=" AND car_make='$make'";
		}
		if(!empty($model)){
		$query.=" AND car_model='$model'";
		}
		if(!empty($year)){
		$query.=" AND car_year='$year'";
	    }
		if(!empty($price)){
		$query.=" AND car_price='$price'";
	    }
		$result= mysqli_query($conn, $query);
		if(mysqli_num_rows($result)== 0){  
			//header("Location: cuscar.php?error=Car not found.");
			//exit();
			echo "<script>
            alert('Car not found.');
            </script>";
						header("Refresh:0");
						exit();	
	    }
		
		echo "<table border='1'>";
		echo "<tr><td>CarPlate</td><td>CarMake</td><td>CarModel</td><td>Price</td><td>CarYear</td><tr>";
		while($row = mysqli_fetch_assoc($result))
		{
		   
		   echo "<tr><td>{$row['car_plate_id']}</td><td>{$row['car_make']}</td><td>{$row['car_model']}</td><td>{$row['car_price']}</td><td>{$row['car_year']}</td><tr>";
		  
		}
		echo"</table>";
		}
		?>

		<br><h3>SEARCH CAR STATUS BY CAR/DATE</h3>
		<form method ="post">
		<label>Enter Car Plate ID:</label>
		<input type="text" name="plate_idv" placeholder="Plate ID"/>
		<label>Enter Status Date:</label>
		<input type="date" name="date" placeholder="Status Date"/>
		<button type="submit" name="searchStatus" value="Search Status" class="btn btn-primary"> Search by Status</button>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['date']) || isset($_POST['plate_idv'])){
			function validate($entry){
			$entry=trim($entry);
			$entry=stripslashes($entry);
			$entry=htmlspecialchars($entry);
			return $entry;
			}		
	
		$id=validate($_POST['plate_idv']);
		$sd=validate($_POST['date']);
	
		if(empty($sd) && empty($id)) {
			//header("Location: cuscar.php?error=Status information required.");
			//exit();
			echo "<script>
            alert('Status Information Required.');
            </script>";
						header("Refresh:0");
						exit();		}
		
		if(empty($sd) || empty($id)){
		$query = "SELECT * FROM car_status INNER JOIN car ON car.car_plate_id=car_status.car_plate_id WHERE car_status_date='$sd' OR car_status.car_plate_id='$id';";
		$result= mysqli_query($conn, $query);
		}
		else
		{
		$query = "SELECT * FROM car_status INNER JOIN car ON car.car_plate_id=car_status.car_plate_id WHERE car_status_date='$sd' AND car_status.car_plate_id='$id';";
		$result= mysqli_query($conn, $query);
		}
		if(mysqli_num_rows($result)== 0){  
			//header("Location: cuscar.php?error=Car status not found.");
			//exit();
			echo "<script>
            alert('Car status not found.');
            </script>";
						header("Refresh:0");
						exit();	
	    }
		echo "<table border='1'>";
		echo "<tr><td>CarPlate</td><td>Status</td><td>StatusDate</td><td>CarMake</td><td>CarModel</td><td>Price</td><td>CarYear</td><tr>";
		while($row = mysqli_fetch_assoc($result))
		{
		   
		   echo "<tr><td>{$row['car_plate_id']}</td><td>{$row['car_status']}</td><td>{$row['car_status_date']}</td><td>{$row['car_make']}</td><td>{$row['car_model']}</td><td>{$row['car_price']}</td><td>{$row['car_year']}</td><tr>";
		  
		}
		echo"</table>";		
		}
		?>
		</div>
</body>
</html>	