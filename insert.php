<?php 
$First_name = $_POST['first_name']
$Last_name = $_POST['last_name']
$Email = $_POST['email']
$Password = $_POST['password']
$Confirm_password = $_POST['confirm_password ']

if (!empty($First_name) || !empty($Last_name) || !empty($Email) || !empty($Password) || !empty($Confirm_password)) {
	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbname = "register";

	//connection
	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	if (mysqli_connect_error()) {
		die('Connect Error(' mysqli_connect_error().')'. mysqli_connect_error())
		
	}else{
		$SELECT = "SELECT email From register Where email = ?";
		$INSERT = "INSERT Into register (First name, Last name, Email, Password, Confirm password) values (?, ? , ?, ?, ?)";

		$stmt = $conn->prepare($SELECT);
		$stmt->bind_param("s", $Email);
		$stmt->execute();
		$stmt->bind_results($Email);
		$stmt->store_results();
		$rnum = $stmt->num rows;
		if ($rnum == 0) {
			$stmt->close();
			$stmt = $conn->prepare($INSERT);
			$stmt->bind_param("sssii",$First_name, $Last_name, $Email, $Password, $Confirm_password);
			$stmt=>execute();
			echo "New record inderted sucessfully";
		}else{
			echo "Someone else already registered using this email";
		}
		$stmt->close();
		$conn->close();
	}
}else{
	echo "All fields are required";
	die();
}
?>