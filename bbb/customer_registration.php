<script>alert('Please enter all values')</script><!-- UI: Prithviraj Narahari, php code: Alexander Martens -->
<head>
<title> CUSTOMER REGISTRATION </title>
</head>
<body>

	<?php
		include_once 'connect_to_database.php';
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

			$sql_customer = "INSERT INTO CUSTOMER (username, PIN, FName, LName, address, city, state, ZIP) VALUES ('$username', '$pin', '$firstname', '$lastname', '$address', '$city', '$state', '$zip')";

			$sql_credit_card = "INSERT INTO CREDIT_CARD (credit_card, card_number, expiration, username) VALUES ('$credit_card', '$card_number', '$expiration', '$username')";

			$check_username = "SELECT * FROM CUSTOMER WHERE username = '$username')";

			if (!empty($conn->query($check_username))) {
				echo("Username already exists");
			}
			else if ($pin != $retype_pin) {
				echo("Pins do not match");
			}
			else if ($conn->query($sql_customer) === TRUE && $conn->query($sql_credit_card) === TRUE) {
  				echo "New account created successfully";
			} else {
				echo "Error: " . $sql_customer . "<br>" . $conn->error;
			}
		}

		$conn->close();
	?>

	<table align="center" style="border:2px solid blue;">
		<tr>
			<form id="register" action="" method="post">
			<td align="right">
				Username<span style="color:red">*</span>:
			</td>
			<td align="left" colspan="3">
				<input type="text" id="username" name="username" placeholder="Enter your username">
			</td>
		</tr>
		<tr>
			<td align="right">
				PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" id="pin" name="pin">
			</td>
			<td align="right">
				Re-type PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" id="retype_pin" name="retype_pin">
			</td>
		</tr>
		<tr>
			<td align="right">
				Firstname<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="firstname" name="firstname" placeholder="Enter your firstname">
			</td>
		</tr>
		<tr>
			<td align="right">
				Lastname<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="lastname" name="lastname" placeholder="Enter your lastname">
			</td>
		</tr>
		<tr>
			<td align="right">
				Address<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="address" name="address">
			</td>
		</tr>
		<tr>
			<td align="right">
				City<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="city" name="city">
			</td>
		</tr>
		<tr>
			<td align="right">
				State<span style="color:red">*</span>:
			</td>
			<td align="left">
				<select id="state" name="state">
				<option selected disabled>select a state</option>
				<option>Michigan</option>
				<option>California</option>
				<option>Tennessee</option>
				</select>
			</td>
			<td align="right">
				Zip<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="text" id="zip" name="zip">
			</td>
		</tr>
		<tr>
			<td align="right">
				Credit Card<span style="color:red">*</span>
			</td>
			<td align="left">
				<select id="credit_card" name="credit_card">
				<option selected disabled>select a card type</option>
				<option>VISA</option>
				<option>MASTER</option>
				<option>DISCOVER</option>
				</select>
			</td>
			<td colspan="2" align="left">
				<input type="text" id="card_number" name="card_number" placeholder="Credit card number">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				Expiration Date<span style="color:red">*</span>:
			</td>
			<td colspan="2" align="left">
				<input type="text" id="expiration" name="expiration" placeholder="MM/YY">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"> 
				<input type="submit" id="register_submit" name="register_submit" value="Register">
			</td>
			</form>
			<form id="no_registration" action="index.php" method="post">
			<td colspan="2" align="center">
				<input type="submit" id="donotregister" name="donotregister" value="Don't Register">
			</td>
			</form>
		</tr>
	</table>
</body>
</HTML>