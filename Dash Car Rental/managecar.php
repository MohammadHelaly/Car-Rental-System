<!DOCTYPE html>
<html>
	<head>
		<title>MANAGE CARS</title>
		<link rel="stylesheet" href="styleadmin.css">
	</head>
<body>
	
		<div class="topnav">
 		<a href=advsearch.php>Advanced Search</a>
 		<a href=manageres.php> Manage Resrvations</a>
  		<a class="active" href=managecar.php>Manage Cars</a>
 		<a href=managecust.php>Manage Customers</a>
		<a href=managepay.php>Manage Payments</a>
		<a href=manageoff.php>Manage Offices</a>
		<a class="logout" href=index.php>logout</a>
		</div>
		<div class="ManageCARR">
		
		<?php if (isset($_GET['error'])) { ?>
		<p class="error"><?php echo $_GET['error']; ?></p>
		<?php } ?>
		<h3>VIEW ALL CARS</h3>
		<form method ="post">
		<button type="submit" name="viewCar" value="View Cars" class="btn btn-primary"> View Cars</button>
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

		<br><h3>SEARCH CARS</h3>
		<form method ="post">
		<label>Enter Car Plate ID:</label>
		<input type="text" name="plate_ids" placeholder="Plate ID"/>
		<label>Enter Car Make:</label>
		<input type="text" name="car_makes" placeholder="Car Make"/>
		<label>Enter Car Model:</label>
		<input type="text" name="car_mods" placeholder="Car Model"/>
		<label>Enter Car Year:</label>
		<input type="text" name="car_years" placeholder="Car Year"/><br><br>
		<label>Enter Car Price:</label>
		<input type="text" name="car_prices" placeholder="Car Price"/>
		<button type="submit" name="searchCars" value="Search Cars" class="btn btn-primary"> Search cars </button>
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
			//header("Location: managecar.php?error=Car information required.");
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
		//echo mysqli_num_rows($result);
		if(mysqli_num_rows($result)== 0){  
			//header("Location: managecar.php?error=Car not found.");
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
		
		<h3>ADD CARS</h3>
		<form method ="post">
		<label>Enter Car Plate ID:</label>
		<input type="text" name="plate_ida" placeholder="Plate ID"/>
		<label>Enter Car Make:</label>
		<input type="text" name="car_makea" placeholder="Car Make"/>
		<label>Enter Car Model:</label>
		<input type="text" name="car_moda" placeholder="Car Model"/>
		<label>Enter Car Year:</label>
		<input type="text" name="car_yeara" placeholder="Car Year"/><br><br>
		<label>Enter Car Price:</label>
		<input type="text" name="car_pricea" placeholder="Car Price"/>
		
		<button type="submit" name="addCar" value="Add Car" class="btn btn-primary"> Add Car </button>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['plate_ida']) && isset($_POST['car_makea']) && isset($_POST['car_moda']) && isset($_POST['car_yeara']) && isset($_POST['car_pricea'])){
			function validate($entry){
			$entry=trim($entry);
			$entry=stripslashes($entry);
			$entry=htmlspecialchars($entry);
			return $entry;
			}		
	
		$id=validate($_POST['plate_ida']);
		$make=validate($_POST['car_makea']);
		$model=validate($_POST['car_moda']);
		$year=validate($_POST['car_yeara']);
		$price=validate($_POST['car_pricea']);
	
		if(empty($id) && empty($make) && empty($model) && empty($year) && empty($price)) {
			//header("Location: managecar.php?error=Car information required.");
			//exit();
						echo "<script>
            alert('Car information required.');
            </script>";
						header("Refresh:0");
						exit();
		}

		if(empty($id)) {
		//	header("Location: managecar.php?error=Car plate ID required.");
			//exit();
						echo "<script>
            alert('Car plate ID required.');
            </script>";
						header("Refresh:0");
						exit();
		}
		
		if(empty($make)) {
			//header("Location: managecar.php?error=Car make required.");
		//	exit();
					echo "<script>
            alert('Car make required.');
            </script>";
						header("Refresh:0");
						exit();
		}
		
		if(empty($model)) {
			//header("Location: managecar.php?error=Car model required.");
		//	exit();
					echo "<script>
            alert('Car model required.');
            </script>";
						header("Refresh:0");
						exit();
		}
		
		if(empty($year)) {
			//header("Location: managecar.php?error=Car year required.");
			//exit();
						echo "<script>
            alert('Car year required.');
            </script>";
						header("Refresh:0");
						exit();
		}
	
		if(empty($price)) {
			//header("Location: managecar.php?error=Car price required.");
		//	exit();
					echo "<script>
            alert('Car price required.');
            </script>";
						header("Refresh:0");
						exit();
		}
		
		$sql="INSERT INTO car(car_plate_id,car_make,car_model,car_year,car_price) VALUES('$id','$make','$model','$year','$price')";
		$result=mysqli_query($conn,$sql);
		$sql2="SELECT * FROM car WHERE car_plate_id='$id' AND car_make='$make' AND car_model='$model' AND car_year='$year' AND car_price='$price'";
		$result2=mysqli_query($conn,$sql2);
		if(mysqli_num_rows($result2)== 1){
			//$row = mysqli_fetch_assoc($result3);
			//$_SESSION['name'] = $row['customer_name'];  
			//echo 'Car added successfully'; //remember echo makes delete disappear
			//header("Location: userhome.php");
			//exit();
			echo "<script>
            alert('Car Added Successfully.');
            </script>";
						header("Refresh:0");
						exit();
	    }
		}
		?>
		
		<br><h3>DELETE CARS</h3>
		<form method ="post">
		<label>Enter Car Plate ID:</label>
		<input type="text" name="car_idd" placeholder="Plate ID"/>
		<button type="submit" name="deleteCar" value="Delete Car" class="btn btn-primary"> Delete Car </button>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['car_idd'])){
			function validate($entry){
			$entry=trim($entry);
			$entry=stripslashes($entry);
			$entry=htmlspecialchars($entry);
			return $entry;
			}		
				
	
		$id=validate($_POST['car_idd']);
	
		if(empty($id)) {
			//header("Location: managecar.php?error=Car plate ID required.");
			//exit();
						echo "<script>
            alert('Car plate ID required.');
            </script>";
						header("Refresh:0");
						exit();
		}
		
		$sqle="SELECT * FROM car WHERE car_plate_id='$id'";
		$resulte=mysqli_query($conn,$sqle);
		if(mysqli_num_rows($resulte)== 0){  
			//header("Location: managecar.php?error=Car not found.");
			//exit();
						echo "<script>
            alert('Car not found.');
            </script>";
						header("Refresh:0");
						exit();
	    }
		
		$sql="DELETE FROM car WHERE car_plate_id='$id'";
		$result=mysqli_query($conn,$sql);
		$sql2="SELECT * FROM car WHERE car_plate_id='$id'";
		$result2=mysqli_query($conn,$sql2);
		if(mysqli_num_rows($result2)== 0){
			//$row = mysqli_fetch_assoc($result3);
			//$_SESSION['name'] = $row['customer_name'];  
			//echo 'Car deleted successfully';
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
		
		<br><h3>VIEW ALL CAR STATUS UPDATES</h3>
		<form method ="post">
		<button type="submit" name="viewStatus" value="View Status" class="btn btn-primary"> View Status </button>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['viewStatus'])){
		$query = "SELECT * FROM car_status INNER JOIN car ON car.car_plate_id=car_status.car_plate_id";
		$result= mysqli_query($conn, $query);
		echo "<table border='1'>";
		echo "<tr><td>CarPlate</td><td>Status</td><td>StatusDate</td><td>CarMake</td><td>CarModel</td><td>Price</td><td>CarYear</td><tr>";
		while($row = mysqli_fetch_assoc($result))
		{
		   
		   echo "<tr><td>{$row['car_plate_id']}</td><td>{$row['car_status']}</td><td>{$row['car_status_date']}</td><td>{$row['car_make']}</td><td>{$row['car_model']}</td><td>{$row['car_price']}</td><td>{$row['car_year']}</td><tr>";
		  
		}
		echo"</table>";
		}
		?>
				<br><h3>UPDATE CAR STATUS</h3>
		<form method ="post">
		<label>Enter Car Plate ID:</label>
		<input type="text" name="plate_idu" placeholder="Plate ID"/>
		<label>Enter Car Status:</label>
		<input type="text" name="status" placeholder="Status"/>
		<label>Enter Status Date:</label>
		<input type="date" name="st_date" placeholder="Status Date"/>
		<button type="submit" name="updateStatus" value="Update Status" class="btn btn-primary">Update Status</button>
		</form>
		<?php
		//$connect = mysqli_connect('localhost','root','','car_rental_system');
		include "db_conn.php";
		//session_start();
		if(isset($_POST['status']) && isset($_POST['plate_idu']) && isset($_POST['st_date'])){
			function validate($entry){
			$entry=trim($entry);
			$entry=stripslashes($entry);
			$entry=htmlspecialchars($entry);
			return $entry;
			}		
	
		$id=validate($_POST['plate_idu']);
		$sd=validate($_POST['st_date']);
		$st=validate($_POST['status']);
		$v1="available";
		$v2="out of service";
	
		if(empty($id)) {
			//header("Location: managecar.php?error=Car plate ID required.");
			//exit();
						echo "<script>
            alert('Car Plate ID required.');
            </script>";
						header("Refresh:0");
						exit();
		}
		
		if(empty($st)) {
			//header("Location: managecar.php?error=Status information required.");
			//exit();
						echo "<script>
            alert('Status Information required.');
            </script>";
						header("Refresh:0");
						exit();
		}
		
		else if(strcmp($st,$v1) != 0 && strcmp($st,$v2) != 0) {
		//header("Location: managecar.php?error=Status invalid.");
		//exit();
					echo "<script>
            alert('Status Invalid.');
            </script>";
						header("Refresh:0");
						exit();
	    }
		
		if(empty($sd)) {
			//$sd=date("Y-m-d");
			//header("Location: managecar.php?error=Status date required.");
			//exit();
						echo "<script>
            alert('Status Date required.');
            </script>";
						header("Refresh:0");
						exit();
		}
		
		$query = "INSERT INTO car_status(car_plate_id,car_status,car_status_date) VALUES ('$id','$st','$sd');";
		$result= mysqli_query($conn, $query);
		//echo mysqli_num_rows($result);
		$sql2="SELECT * FROM car_status WHERE car_plate_id='$id' AND car_status_date='$sd'";
		$result2=mysqli_query($conn,$sql2);
		if(mysqli_num_rows($result2)== 1){
			//$row = mysqli_fetch_assoc($result3);
			//$_SESSION['name'] = $row['customer_name'];  
			//echo 'Status updated successfully'; //remember echo makes delete disappear
			//header("Location: userhome.php");
			//exit();
			echo "<script>
            alert('Status Updated Successfully.');
            </script>";
						header("Refresh:0");
						exit();
	    }
		}
		?>
		
		<br><h3>SEARCH CAR STATUS BY CAR/DATE</h3>
		<form method ="post">
		<label>Enter Car Plate ID:</label>
		<input type="text" name="plate_idv" placeholder="Plate ID"/>
		<label>Enter Status Date:</label>
		<input type="date" name="date" placeholder="Status Date"/>
		<button type="submit" name="searchStatus" value="Search Status" class="btn btn-primary"> Search Status </button>
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
			//header("Location: managecar.php?error=Status information required.");
			//exit();
						echo "<script>
            alert('Status Information required.');
            </script>";
						header("Refresh:0");
						exit();
		}
		
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
			//header("Location: managecar.php?error=Car status not found.");
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