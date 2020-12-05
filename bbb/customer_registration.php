<?php
	include_once 'connect_to_database.php';
?>

<script>
    var alerted = localStorage.getItem('alerted') || '';
    if (alerted != 'yes') {
     alert('Please enter all values');
     localStorage.setItem('alerted','yes');
    }
</script>

<!-- UI: Prithviraj Narahari, php code: Alexander Martens -->
<head>
<title> CUSTOMER REGISTRATION </title>
</head>
<body>

	 <?php 
		if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
			$username = $_POST["username"];
			$pin = $_POST["pin"];
			$retype_pin = $_POST["retype_pin"];
			$firstname = $_POST["firstname"];
			$lastname = $_POST["lastname"];
			$address = $_POST["address"];
			$city = $_POST["city"];
			$state = $_POST["state"];
			$zip = $_POST["zip"];
			$credit_card = $_POST["credit_card"];
			$card_number = $_POST["card_number"];
			$expiration = $_POST["expiration"];
			
			$SQL = "SELECT username FROM bbb_user";
			$result = mysqli_query($conn, $SQL);
			$resultCheck = mysqli_num_rows($result);
			//$user_exists = false;
			if($resultCheck > 0 ){
				while($row = mysqli_fetch_array($result)) {
					if($username === $row['username']) {
						echo '<script>alert("Username already exists")</script>'; 
					}
				}
			} 
			$error = false;
			if ($pin != $retype_pin) {
				echo '<script>alert("Pins do not match")</script>';
			} else {
				$sql_bbb_user = "INSERT INTO BBB_USER (username, PIN, type, FName, LName, address, city, state, ZIP) VALUES ('$username', '$pin', 1, '$firstname', '$lastname', '$address', '$city', '$state', '$zip')";
				
				if (mysqli_query($conn, $sql_bbb_user)) {
					echo "User successfully registered."; 
				} else {
					$error = true;
					echo '<script>alert("Error entering user info")</script>'; 
				}
				
				$sql_credit_card = "INSERT INTO CREDIT_CARD (card_number, card_type, expiration, username) VALUES ('$card_number', '$credit_card', '$expiration', '$username')";
				
				if (!$error) {
					if (mysqli_query($conn, $sql_credit_card)) {
						echo "Credit Card successfully registered."; 
					} else {
						$error = true;
						echo '<script>alert("Error entering credit card info")</script>'; 
					}
				}
				
				if (!$error) {
					echo '<script>alert("New user and credit card info entered successfully.")</script>'; 
					echo '<script>window.location.href="screen2.php"</script>';
				}
			}
			
			
			

		} 

		$conn->close();
	?>

	<table align="center" style="border:2px solid blue;">
		<tr>
			<form id="register" action = "" method = "POST">
			<td align="right">
				Username<span style="color:red">*</span>:
			</td>
			<td align="left" colspan="3">
				<input type="text" id="username" name="username" placeholder="Enter your username" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" id="pin" name="pin" required>
			</td>
			<td align="right">
				Re-type PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" id="retype_pin" name="retype_pin" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				Firstname<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="firstname" name="firstname" placeholder="Enter your firstname" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				Lastname<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="lastname" name="lastname" placeholder="Enter your lastname" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				Address<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="address" name="address" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				City<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="city" name="city" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				State<span style="color:red">*</span>:
			</td>
			<td align="left">
				<select id="state" name="state" required>
				<option value="">select a state</option>
				<option>AL</option>
				<option>AK</option>
				<option>AZ</option>
				<option>AR</option>
				<option>CA</option>
				<option>CO</option>
				<option>CT</option>
				<option>DE</option>
				<option>FL</option>
				<option>GA</option>
				<option>HI</option>
				<option>ID</option>
				<option>IL</option>
				<option>IN</option>
				<option>IA</option>
				<option>KS</option>
				<option>KY</option>
				<option>LA</option>
				<option>ME</option>
				<option>MD</option>
				<option>MA</option>
				<option>MI</option>
				<option>MN</option>
				<option>MS</option>
				<option>MO</option>
				<option>MT</option>
				<option>NE</option>
				<option>NV</option>
				<option>NH</option>
				<option>NJ</option>
				<option>NM</option>
				<option>NY</option>
				<option>NC</option>
				<option>ND</option>
				<option>OH</option>
				<option>OK</option>
				<option>OR</option>
				<option>PA</option>
				<option>RI</option>
				<option>SC</option>
				<option>SD</option>
				<option>TN</option>
				<option>TX</option>
				<option>UT</option>
				<option>VT</option>
				<option>VA</option>
				<option>WA</option>
				<option>WV</option>
				<option>WI</option>
				<option>WY</option>
				</select>
			</td>
			<td align="right">
				Zip<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="text" id="zip" name="zip" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				Credit Card<span style="color:red">*</span>
			</td>
			<td align="left">
				<select id="credit_card" name="credit_card" required>
				<option value="">select a card type</option>
				<option>VISA</option>
				<option>MASTER</option>
				<option>DISCOVER</option>
				</select>
			</td>
			<td colspan="2" align="left">
				<input type="text" id="card_number" name="card_number" placeholder="Credit card number" required>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				Expiration Date<span style="color:red">*</span>:
			</td>
			<td colspan="2" align="left">
				<input type="text" id="expiration" name="expiration" placeholder="MM/YY" required>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"> 
				<input type="submit" id="register_submit" name="register_submit" value="Register">
			</td>
			</form>
		<form id="no_registration" action="registration_message.php" method="post">
			<td colspan="2" align="center">
				<input type="submit" id="donotregister" name="donotregister" value="Don't Register">
			</td>
		</form>
		</tr>
	</table>
</body>
</HTML>