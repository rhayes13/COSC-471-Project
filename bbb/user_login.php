<?php
	include_once 'connect_to_database.php';
?>
<?php
	// Start the session
	session_start();

	$redirect = "user_login.php";
	$valid = 0;

	if(isset($_POST["username"])) {
		$enteredUser = $_POST["username"];
		$enteredPIN = $_POST["pin"];
		$_SESSION["user"] = $_POST["username"];
		$sql_query = "SELECT * FROM bbb_user WHERE username='$enteredUser';"; 
		$mysqli_result = $conn->query($sql_query); 
				

		if(mysqli_num_rows($mysqli_result) > 0 ){
			while($row = mysqli_fetch_array($mysqli_result)) {
				$username = $row['username'];
			}
		}
		$sql_query2 = "SELECT * FROM bbb_user WHERE username='$username';"; 
		$mysqli_result2 = $conn->query($sql_query2); 
		if(mysqli_num_rows($mysqli_result2) > 0 ){
			while($row = mysqli_fetch_array($mysqli_result2)) {
				$PIN = $row['PIN'];

				if($enteredUser == $username && $enteredPIN == $PIN && $enteredUser != "") {
					$redirect = "screen2.php";
					$valid = 1;
				}
			}
		}
	}

	// To next page!
	function display()
	{
	    header("Refresh:0; url=screen2.php");
	}

	if(isset($_POST['login']) && $valid = 1)
	{
	   display();
	} 
	
?>

<!DOCTYPE HTML>
<head>
<title>User Login</title>
</head>
<body>
	<table align="center" style="border:2px solid blue;">
		<?php 
			echo "<form action='" . $redirect . "' method='post' id='login_screen'>";
		?>
		
		<tr>
			<td align="right">
				Username<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="text" name="username" id="username">
			</td>
			<td align="right">
				<input type="submit" name="login" id="login" value="Login">
			</td>
		</tr>
		<tr>
			<td align="right">
				PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" name="pin" id="pin">
			</td>
			</form>
			<form action="index.php" method="post" id="login_screen">
			<td align="right">
				<input type="submit" name="cancel" id="cancel" value="Cancel">
			</td>
			</form>
		</tr>
	</table>
</body>

</html>
