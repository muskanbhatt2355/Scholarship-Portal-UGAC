<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<div><button type="button" class="btn btn-warning" style="float:right;"><a href="logout.php">Logout</a></button></div>
	<h2 style="font-family:NSimSun;letter-spacing: 1px;word-spacing:4px;color: black;text-align: center;">ADD A NEW SCHOLARSHIP</h2>
	<div class="container" style="max-width: 800px;" >
		<form method="post">
			<div class="form-group">
				<label for="sch_name">Name:</label><br>
	  			<input type="text" class="form-control" id="sch_name" name="sch_name"><br>
			</div>
			<div class="form-group">
				<label for="details">Details/Eligibility:</label><br>
	  			<textarea class="form-control" id="details" name="details" ></textarea><br>
			</div>
			<div class="form-group">
				<label for="incentives">Incentives:</label><br>
	  			<textarea class="form-control" id="incentives" name="incentives" ></textarea><br>
			</div>
	  		<div class="form-group">
	  			<label for="link">Link:</label><br>
	  			<input type="text" class="form-control" id="link" name="link"><br>
			</div>		
	  		
			<h6 style="font-family:Arial;letter-spacing: 0.5px;padding-top: 0px;">Select tags:</h6>
			<div class="form-check">
			  <label class="form-check-label" style="color:grey;">
			    <p><input type="checkbox" name="filter[]" value="international" /> International</p>
			  </label>
			</div>
			<div class="form-check">
			  <label class="form-check-label" style="color:grey;">
			   	<p><input type="checkbox" name="filter[]" value="national" /> National</p>
			  </label>
			</div>

			<h6 style="font-family:Arial;letter-spacing: 0.5px;padding-top: 0px;"> Select category:</h6>			
			<div class="form-check">
			  <label class="form-check-label" style="color:grey;">
			   	<p><input type="checkbox" name="filter[]" value="merit" /> Merit-based for all</p>
			  </label>
			</div>
			<div class="form-check">
			  <label class="form-check-label" style="color:grey;">
			   	<p><input type="checkbox" name="filter[]" value="girls" /> Only for Girls</p>
			  </label>
			</div>
			<div class="form-check">
			  <label class="form-check-label" style="color:grey;">
			   	<p><input type="checkbox" name="filter[]" value="scst" /> Only for SC/ST students</p>
			  </label>
			</div>
			<div class="form-check">
			  <label class="form-check-label" style="color:grey;">
			   	<p><input type="checkbox" name="filter[]" value="bs" /> Only for BS students</p>
			  </label>
			</div>
			<div class="form-check">
			  <label class="form-check-label" style="color:grey;">
			   	<p><input type="checkbox" name="filter[]" value="first" /> Only for first year students</p>
			  </label>
			</div>
			<div class="form-check">
			  <label class="form-check-label" style="color:grey;">
			   	<p><input type="checkbox" name="filter[]" value="minority" /> For minorities</p>
			  </label>
			</div>
			<div class="form-check">
			  <label class="form-check-label" style="color:grey;">
			   	<p><input type="checkbox" name="filter[]" value="special" /> For Specially-abled students</p>
			  </label>
			</div>

			<h6 style="font-family:Arial;letter-spacing: 0.5px;padding-top: 0px;"> Select additional filters:</h6>
			<div class="form-check">
			  <label class="form-check-label" style="color:grey;">
			   	<p><input type="checkbox" name="filter[]" value="financial" /> With Financial Constraints</p>
			  </label>
			</div>
			<div class="form-check">
			  <label class="form-check-label" style="color:grey;">
			   	<p><input type="checkbox" name="filter[]" value="sports" /> Sports</p>
			  </label>
			</div>
			<div class="form-check">
			  <label class="form-check-label" style="color:grey;">
			   	<p><input type="checkbox" name="filter[]" value="highed" /> Higher Education</p>
			  </label>
			</div>
			<div class="form-check">
			  <label class="form-check-label" style="color:grey;">
			   	<p><input type="checkbox" name="filter[]" value="state" /> State Scholarships</p>
			  </label>
			</div>
			<div class="form-check">
			  <label class="form-check-label" style="color:grey;">
			   	<p><input type="checkbox" name="filter[]" value="research" /> Research and Internship abroad</p>
			  </label>
			</div>
			<div class="form-check">
			  <label class="form-check-label" style="color:grey;">
			   	<p><input type="checkbox" name="filter[]" value="exchange" /> Exchange Program</p>
			  </label>
			</div>
			
				
			
			
			
						
						
			
			
			<!--<h3>Is it active?</h3>
			<input type="checkbox" name="act[]" value="active" />Yes<br>
			<input type="checkbox" name="act[]" value="inactive" />No<br>-->

			<input type="submit" style="align-self: center;" name="submit" value="Submit" />
		</form>
	</div>
	<?php

	$servername = "localhost";
	$username = "root";
	$password = "";

	$con = mysqli_connect($servername, $username, $password,'scholarship_portal1');

	if (!$con) {
	    die('Could not connect: ' . mysqli_error($con));
	}



	if(isset($_POST["submit"])){
		$sch_name = $_POST['sch_name'];
		$details = $_POST['details'];
		$incentives = $_POST['incentives'];
		$link = $_POST['link'];

		$insert = "INSERT";
		$into = " INTO scholarship_portal2020_db (name,details,incentives,link";
		$values = " VALUES ('$sch_name','$details','$incentives','$link'";	

		$opts = isset($_POST['filter'])? $_POST['filter'] : array('');
		$stat = isset($_POST['act'])? $_POST['act'] : array('');

		if (in_array('international', $opts)){
		    $into .= ",international";
		    $values .= ",1";
		 }
		 if (in_array('national', $opts)){
		    $into .= ",national";
		    $values .= ",1";
		 }
		 if (in_array('merit', $opts)){
		    $into .= ",merit";
		    $values .= ",1";
		 }
		 if (in_array('girls', $opts)){
		    $into .= ",girl";
		    $values .= ",1";
		 }
		 if (in_array('scst', $opts)){
		    $into .= ",scst";
		    $values .= ",1";
		 }
		 if (in_array('bs', $opts)){
		    $into .= ",bs";
		    $values .= ",1";
		 }
		 if (in_array('first', $opts)){
		    $into .= ",first";
		    $values .= ",1";
		 }
		 if (in_array('minority', $opts)){
		    $into .= ",minority";
		    $values .= ",1";
		 }
		 if (in_array('special', $opts)){
		    $into .= ",special";
		    $values .= ",1";
		 }
		 if (in_array('financial', $opts)){
		    $into .= ",financial";
		 }
		 if (in_array('sports', $opts)){
		    $into .= ",sports";
		    $values .= ",1";
		 }
		 if (in_array('highed', $opts)){
		    $into .= ",highed";
		    $values .= ",1";
		 }
		 if (in_array('state', $opts)){
		    $into .= ",state";
		    $values .= ",1";
		 }
		 if (in_array('research', $opts)){
		    $into .= ",research";
		    $values .= ",1";
		 }
		 if (in_array('exchange', $opts)){
		    $into .= ",exchange";
		    $values .= ",1";
		 }

		 /*if (in_array('inactive', $stat)){
		    $into .= ",active";
		    $values .= ",0";
		 }*/

		 $into .= ") ";
		 $values .= ")";




		$sql = $insert . $into . $values;
	 	$result = mysqli_query($con,$sql);

	 	if ($result) {
		echo "New scholarship added successfully !";
	 	} else {
		echo "Error: " . $sql . " " . mysqli_error($con);
	 }
	
		mysqli_close($con);


	}


	

?>
</body>
</html>