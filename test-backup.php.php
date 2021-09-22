<!DOCTYPE html>
<html>
<head>
<title>Title of the document</title>
</head>
<body>
<form method="post">
Name : <input type="text" name="name" id = "name"/><br/><br/>
Email: <input type = "text" name = "email" id = "email"/><br/><br/>
Phone: <input type = "text" name = "phone" id = "phone"/><br/><br/>
Gender: <input type = "radio" name = "gender" id = "gender" value="Male" />Male<input type = "radio" name = "gender" id = "gender" value="Female" />Female<br/><br/>
<input type = "submit" name = "add_user" id = "add_user" value="Add User"/>
</form>
</body>
</html>
<?php
function db_connection(){
$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "Anshul";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	return $conn;
}
if(isset($_POST["add_user"])){
	$conn = db_connection();
	
	
	$name = $_POST["name"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$gender = $_POST["gender"];
	
	$sql = "INSERT INTO user (name, email, phone, gender)
	VALUES ('$name', '$email', '$phone', '$gender')";
	//echo $sql; die;
	//$conn->query($sql);
	
	if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
 	
}

?>

<table>
<tr>
<td>Name</td>
<td> Email</td>
<td>Phone Number</td>
<td>Gender</td>
</tr>

<?php 
$conn = db_connection();
$sql = "Select * from user";
$result->$conn->query($sql);
	// Fetch all
$result->fetch_all(MYSQLI_ASSOC);

// Free result set
$result->free_result();

$conn->close();
 
 
	
?>
<?php
echo "<pre>";
print_r($_GET);
?>