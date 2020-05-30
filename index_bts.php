<!doctype html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hello, Bootstrap Table!</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
	<link rel="stylesheet" href="home.css">

</head>

<body style="background-image: linear-gradient(-90deg, #000099, #80ffdf);width:100%;overflow-y:">
<div class = "container-fluid">
<header class="w-100 p-3 h-25" style="float: left;background-color:white;width:100%;margin-right: 0;">
	<img src="ugac.png" alt="UGAC" style="width:15vw;height:auto;float:left;margin-top:0vw;margin-left: 2vw;">
	<h1 style="float: center;font-family: 'Allan';font-size: 6vw;margin-top: 2vw;margin-left:23vw;margin-bottom: 0;">Scholarship Portal</h1>
	<button type="button" class="btn btn-warning" style="float: right;margin-top: 0;padding-top: 0;"><a href="admin_login.php">Admin Login</a></button>
</header>


<div>
<div class="jumbotron" style="float:left;margin-right: 0px;margin-left: 1vw; margin-top: 3vw;padding-top: 1vw;padding-bottom:0;padding-left:1vw;padding-right:1vw;font-family: Franklin Gothic Medium;font-size:15px;line-height: 0.5;background-color: #f0f5f5;">
	<form method="post">
		<!--<p><input type="checkbox" name="filter[]" value="allent" />Show all</p>-->
		<h4 style="Franklin Gothic Medium;padding-top: 0px;background-image: linear-gradient(-90deg, #00e6ac, #00004d);color:#f0f5f5; "> Select either or both:</h3>
		<p><input type="checkbox" name="filter[]" value="international" <?php if(in_array('international',$_POST['filter'])) echo "checked='checked'"; ?>  /> International</p>
		<p><input type="checkbox" name="filter[]" value="national" <?php if(in_array('national',$_POST['filter'])) echo "checked='checked'"; ?>  /> National</p>
		<h4 style="Franklin Gothic Medium;padding-top: 0px;background-image: linear-gradient(-90deg, #00e6ac, #00004d);color:#f0f5f5; "> Select category:</h3>
		<p><input type="checkbox" name="filter[]" value="merit" <?php if(in_array('merit',$_POST['filter'])) echo "checked='checked'"; ?> /> Merit-based for all</p>
		<p><input type="checkbox" name="filter[]" value="girls" <?php if(in_array('girls',$_POST['filter'])) echo "checked='checked'"; ?> /> Only for Girls</p>
		<p><input type="checkbox" name="filter[]" value="scst" <?php if(in_array('scst',$_POST['filter'])) echo "checked='checked'"; ?> /> Only for SC/ST students</p>
		<p><input type="checkbox" name="filter[]" value="bs" <?php if(in_array('bs',$_POST['filter'])) echo "checked='checked'"; ?> /> Only for BS students</p>
		<p><input type="checkbox" name="filter[]" value="first" <?php if(in_array('first',$_POST['filter'])) echo "checked='checked'"; ?> /> Only for first year students</p>
		<p><input type="checkbox" name="filter[]" value="minority" <?php if(in_array('minority',$_POST['filter'])) echo "checked='checked'"; ?> /> For minorities</p>
		<p><input type="checkbox" name="filter[]" value="special" <?php if(in_array('special',$_POST['filter'])) echo "checked='checked'"; ?> /> For Specially-abled students</p>
		<h4 style="Franklin Gothic Medium;padding-top: 0px;background-image: linear-gradient(-90deg, #00e6ac, #00004d);color:#f0f5f5; "> Select additional filters:</h3>
		<p><input type="checkbox" name="filter[]" value="financial" <?php if(in_array('financial',$_POST['filter'])) echo "checked='checked'"; ?> /> With Financial Constraints</p>
		<p><input type="checkbox" name="filter[]" value="sports" <?php if(in_array('sports',$_POST['filter'])) echo "checked='checked'"; ?> /> Sports</p>
		<p><input type="checkbox" name="filter[]" value="highed" <?php if(in_array('highed',$_POST['filter'])) echo "checked='checked'"; ?>  /> Higher Education</p>
		<p><input type="checkbox" name="filter[]" value="state" <?php if(in_array('state',$_POST['filter'])) echo "checked='checked'"; ?> /> State Scholarships</p>
		<p><input type="checkbox" name="filter[]" value="research" <?php if(in_array('research',$_POST['filter'])) echo "checked='checked'"; ?> /> Research and Internship abroad</p>
		<p><input type="checkbox" name="filter[]" value="exchange" <?php if(in_array('exchange',$_POST['filter'])) echo "checked='checked'"; ?> /> Exchange Program</p>
		<p><input type="submit" name="submit" value="Submit" /></p>
	</form>
</div>
<div class='table-title' style="float:center;margin-top: 2vw;">
<div class='table-wrapper-scroll-y my-custom-scrollbar'>
<?php
$arr = array();
if(isset($_POST["submit"])){
	if(!empty($_POST["filter"])){
		//echo"<h3>Your Scholarships</h3>";
		//echo "<br>";	
		foreach($_POST["filter"] as $filter){
			array_push($arr,$filter);
			//echo $filter." ";
		}
	}
	else{
		//echo 'All Scholarships';
	}
}

$servername = "localhost";
$username = "root";
$password = "";

$con = mysqli_connect($servername, $username, $password,'scholarship_portal1');

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$select = 'SELECT *';
$from = ' FROM scholarship_portal2020_db';
$where = ' WHERE (allent = 1';
$opts = isset($_POST['filter'])? $_POST['filter'] : array('allent');

$a = 0;
$b = 0;
$c = 0;

if (in_array('international', $opts)){
	if($a==0){
		$where .= ") AND (international = 1";
		$a = $a + 1;
	}
	else{
		$where .= " OR international = 1";
		$a = $a + 1;
	}
    
 }
 if (in_array('national', $opts)){
    if($a==0){
		$where .= ") AND (national = 1";
		$a = $a + 1;
	}
	else{
		$where .= " OR national = 1";
		$a = $a + 1;
	}
 }
 if (in_array('merit', $opts)){
    if($b==0){
		$where .= ") AND (merit = 1";
		$b = $b + 1;
	}
	else{
		$where .= " OR merit = 1";
		$b = $b + 1;
	}
 }
 if (in_array('girls', $opts)){
    if($b==0){
		$where .= ") AND (girls = 1";
		$b = $b + 1;
	}
	else{
		$where .= " OR girls = 1";
		$b = $b + 1;
	}
 }
 if (in_array('scst', $opts)){
    if($b==0){
		$where .= ") AND (scst = 1";
		$b = $b + 1;
	}
	else{
		$where .= " OR scst = 1";
		$b = $b + 1;
	}
 }
 if (in_array('bs', $opts)){
    if($b==0){
		$where .= ") AND (bs = 1";
		$b = $b + 1;
	}
	else{
		$where .= " OR bs = 1";
		$b = $b + 1;
	}
 }
 if (in_array('first', $opts)){
    if($b==0){
		$where .= ") AND (first = 1";
		$b = $b + 1;
	}
	else{
		$where .= " OR first = 1";
		$b = $b + 1;
	}
 }
 if (in_array('minority', $opts)){
    if($b==0){
		$where .= ") AND (minority = 1";
		$b = $b + 1;
	}
	else{
		$where .= " OR minority = 1";
		$b = $b + 1;
	}
 }
 if (in_array('special', $opts)){
    if($b==0){
		$where .= ") AND (special = 1";
		$b = $b + 1;
	}
	else{
		$where .= " OR special = 1";
		$b = $b + 1;
	}
 }
 if (in_array('financial', $opts)){
    if($c==0){
		$where .= ") OR (financial = 1";
		$c = $c + 1;
	}
	else{
		$where .= " OR financial = 1";
		$c = $c + 1;
	}
 }
 if (in_array('sports', $opts)){
    if($c==0){
		$where .= ") OR (sports = 1";
		$c = $c + 1;
	}
	else{
		$where .= " OR sports = 1";
		$c = $c + 1;
	}
 }
 if (in_array('highed', $opts)){
    if($c==0){
		$where .= ") OR (highed = 1";
		$c = $c + 1;
	}
	else{
		$where .= " OR highed = 1";
		$c = $c + 1;
	}
 }
 if (in_array('state', $opts)){
    if($c==0){
		$where .= ") OR (state = 1";
		$c = $c + 1;
	}
	else{
		$where .= " OR state = 1";
		$c = $c + 1;
	}
 }
 if (in_array('research', $opts)){
    if($c==0){
		$where .= ") OR (research = 1";
		$c = $c + 1;
	}
	else{
		$where .= " OR research = 1";
		$c = $c + 1;
	}
 }
 if (in_array('exchange', $opts)){
    if($c==0){
		$where .= ") OR (exchange = 1";
		$c = $c + 1;
	}
	else{
		$where .= " OR exchange = 1";
		$c = $c + 1;
	}
 }
 

 $sql = $select . $from . $where.")";
 $result = mysqli_query($con,$sql);
 //echo $where;

 $number = 1;


	echo "<table class='table-fill'>
	<thead>
	<tr>
	<th>Sr.No.</th>
	<th>Name</th>
	<th>Details/Eligibility</th>
	<th>Incentives</th>
	<th>Online Link/Procedure</th>
	</tr>
	</thead>";
	echo "<tbody>";
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
				
		echo "<td>" . $number . "</td>";
	    echo "<td>" . $row['name'] . "</td>";
	    echo "<td>" . $row['details'] . "</td>";
	    echo "<td>" . $row['incentives'] . "</td>";
	    echo "<td>" . $row['link'] . "</td>";
	    echo "</tr>";

	    $number = $number + 1;
	}
	echo "</tbody>
	</table>";
	mysqli_close($con);

?>
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
</body>
</html>
