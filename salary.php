<html>
<head>
<title> find the gross salary of an Employee</title>
</head>
<body>
<form method="post">

Name :<input type = "text" name = "name" id = "name" /><br><br>
basicsalary : <input type="text" name="basicsalary" placeholder ="Enter basic salary"/><br>



<input type="submit" name="add_data" id = "add_data" value="Add Data"/>

</form>
<?php
function db_connection(){
$servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "Anshul";
  $conn = new mysqli($servername, $username, $password, $dbname);
  return $conn;
}
if(isset($_POST['add_data']))
{
$conn = db_connection();
$name = $_POST["name"];
$basicsalary = $_POST["basicsalary"];

if($_POST["add_data"] == "Add Data"){
$allowance = 0.4 * $basicsalary;
$pf = 0.08 * $basicsalary;
$grosssalary = $basicsalary + $allowance - $pf;
$sql = "Insert into wages (name, basicsalary, allowance, pf, grosssalary)
	values('$name', '$basicsalary', '$allowance', '$pf', '$grosssalary')";
	
	if ($conn->query($sql) === TRUE){
	  echo "New record created successfully"."<br>";
	echo  "basicsalary". "$basicsalary" ."<br>";
	echo "allowance". "$allowance". "<br>";
	echo  "pf" ."$pf". "<br>";
	echo "grosssalary". "$grosssalary";
	}  else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
}
	$conn->close();
}
?>
</body>
</html>
