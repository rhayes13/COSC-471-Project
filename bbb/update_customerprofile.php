<?php
	include_once 'connect_to_database.php';
	
	// Start the session
	session_start();
			
	//$SQL = "SELECT * FROM bbb_user NATURAL JOIN credit_card WHERE username = " . $_SESSION["user"] . ";";
	$SQL = "SELECT * FROM bbb_user NATURAL JOIN credit_card WHERE username = 'user_two'";
	$result = mysqli_query($conn, $SQL);
	$resultCheck = mysqli_num_rows($result);
	$username;
	//$pin;
	$fname;
	$lname;
	$address;
	$city;
	$state;
	$zip;
	$card_type;
	$credit_card;
	$expiration_date;
			
	if($resultCheck > 0 ){
		while($row = mysqli_fetch_array($result)) {
			$username = $row['username'];
			//$pin = $row['PIN'];
			$fname = $row['FName'];
			$lname = $row['LName'];
			$address = $row['address'];
			$city = $row['city'];
			$state = $row['state'];
			$zip = $row['ZIP'];
			$card_type = $row['card_type'];
			$card_number = $row['card_number'];
			$expiration_date = $row['expiration'];
		}
	}
?>

<script>
	var alerted = localStorage.getItem('alerted') || '';
	if (alerted != 'yes') {
		alert('Please enter all values');
		localStorage.setItem('alerted','yes');
    }
	
	function pageLoad(){
		var username = "<?php echo $username ?>";
		document.getElementById("username").innerHTML = "&nbsp" + username;
		var FName = "<?php echo $fname ?>";
		document.getElementById('firstname').value = FName;
		var LName = "<?php echo $lname ?>";
		document.getElementById('lastname').value = LName;
		var address = "<?php echo $address ?>";
		document.getElementById('address').value = address;
		var city = "<?php echo $city ?>";
		document.getElementById('city').value = city;
		selectState();
		var zip = <?php echo $zip ?>;
		document.getElementById('zip').value = zip;
	}
	
	function selectState() {
		var state = "<?php echo $state ?>";
		if (state === "AL")
			document.getElementById('state').value = "AL";
		else if (state === "AK")
			document.getElementById('state').value = "AK";
		else if (state === "AZ") 
			document.getElementById('state').value = "AZ";
        else if (state === "AR") 
			document.getElementById('state').value = "AR";
		else if (state === "CA") 
			document.getElementById('state').value = "CA";
		else if (state === "CO") 
			document.getElementById('state').value = "CO";
		else if (state === "CT") 
			document.getElementById('state').value = "CT";
        else if (state === "DE") 
			document.getElementById('state').value = "DE";
		else if (state === "FL") 
			document.getElementById('state').value = "FL"; 
		else if (state === "GA") 
			document.getElementById('state').value = "GA";
		else if (state === "HI") 
			document.getElementById('state').value = "HI";
        else if (state === "ID") 
			document.getElementById('state').value = "ID";
		else if (state === "IL") 
			document.getElementById('state').value = "IL";
		else if (state === "IN") 
			document.getElementById('state').value = "IN"; 
		else if (state === "IA") 
			document.getElementById('state').value = "IA";
        else if (state === "KS") 
			document.getElementById('state').value = "KS"; 
		else if (state === "KY") 
			document.getElementById('state').value = "KY";
		else if (state === "LA") 
			document.getElementById('state').value = "LA";
		else if (state === "ME") 
			document.getElementById('state').value = "ME";
        else if (state === "MD") 
			document.getElementById('state').value = "MD";
		else if (state === "MA") 
			document.getElementById('state').value = "MA";
		else if (state === "MI") 
			document.getElementById('state').value = "MI";
		else if (state === "MN") 
			document.getElementById('state').value = "MN";
        else if (state === "MS") 
			document.getElementById('state').value = "MS";
		else if (state === "MO") 
			document.getElementById('state').value = "MO";
		else if (state === "MT") 
			document.getElementById('state').value = "MT";
		else if (state === "NE") 
			document.getElementById('state').value = "NE";
        else if (state === "NV") 
			document.getElementById('state').value = "NV";
		else if (state === "NH") 
			document.getElementById('state').value = "NH"; 
		else if (state === "NJ") 
			document.getElementById('state').value = "NJ";
		else if (state === "NM") 
			document.getElementById('state').value = "NM";
        else if (state === "NY") 
			document.getElementById('state').value = "NY";
		else if (state === "NC") 
			document.getElementById('state').value = "NC";
		else if (state === "ND") 
			document.getElementById('state').value = "ND";
		else if (state === "OH") 
			document.getElementById('state').value = "OH";
        else if (state === "OK") 
			document.getElementById('state').value = "OK";
		else if (state === "OR") 
			document.getElementById('state').value = "OR";
		else if (state === "PA") 
			document.getElementById('state').value = "PA";
		else if (state === "RI") 
			document.getElementById('state').value = "RI";
        else if (state === "SC") 
			document.getElementById('state').value = "SC";
		else if (state === "SD") 
			document.getElementById('state').value = "SD";
		else if (state === "TN") 
			document.getElementById('state').value = "TN";
		else if (state === "TX") 
			document.getElementById('state').value = "TX";
        else if (state === "UT") 
			document.getElementById('state').value = "UT";
		else if (state === "VT") 
			document.getElementById('state').value = "VT";
		else if (state === "VA") 
			document.getElementById('state').value = "VA";
		else if (state === "WA")
			document.getElementById('state').value = "WA";
        else if (state === "WV") 
			document.getElementById('state').value = "WV";
		else if (state === "WI")
			document.getElementById('state').value = "WI";
		else if (state === "WY")
			document.getElementById('state').value = "WY";
		else
			Console.log("No state found");
	}

	window.onload = pageLoad;

</script><!DOCTYPE HTML>
<head>
<title>UPDATE CUSTOMER PROFILE</title>

</head>
<body>

	<?php
		if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
			$new_pin = $_POST["new_pin"];
			$retypenew_pin = $_POST["retypenew_pin"];
			$new_firstname = $_POST["firstname"];
			$new_lastname = $_POST["lastname"];
			$new_address = $_POST["address"];
			$new_city = $_POST["city"];
			$new_state = $_POST["state"];
			$new_zip = $_POST["zip"];
			$new_credit_card = $_POST["credit_card"];
			$new_card_number = $_POST["card_number"];
			$new_expiration = $_POST["expiration_date"];

			$pin_update = false;
			$fname_update = false;
			$lname_update = false;
			$address_update = false;
			$city_update = false;
			$state_update = false;
			$zip_update = false;
			$cc_update = false;

			if ($new_pin != $retypenew_pin) {
				echo '<script>alert("Pins do not match")</script>'; 
			} else if (!empty($new_pin)) {
				$sql = "UPDATE bbb_user SET PIN = '" . $new_pin . "' WHERE username = '" . $username . "'";
				
				if (mysqli_query($conn, $sql)) {
				  echo "PIN updated successfully\n";
				  $pin_update = true;
				} else {
				  echo "Error updating record: " . mysqli_error($conn) . "\n";
				}
			}
			
			if ($fname != $new_firstname && !empty($new_firstname)) {
				$sql = "UPDATE bbb_user SET Fname = '" . $new_firstname . "' WHERE username = '" . $username . "'";
				
				if (mysqli_query($conn, $sql)) {
				  echo "FName updated successfully\n";
				  $fname_update = true;
				} else {
				  echo "Error updating record: " . mysqli_error($conn) . "\n";
				}
			}
			
			if ($lname != $new_lastname && !empty($new_lastname)) {
				$sql = "UPDATE bbb_user SET LName = '" . $new_lastname . "' WHERE username = '" . $username . "'";
				
				if (mysqli_query($conn, $sql)) {
				  echo "LName updated successfully\n";
				  $lname_update = true;
				} else {
				  echo "Error updating record: " . mysqli_error($conn) . "\n";
				}
			}
			
			if ($address != $new_address && !empty($new_address)) {
				$sql = "UPDATE bbb_user SET address = '" . $new_address . "' WHERE username = '" . $username . "'";
				
				if (mysqli_query($conn, $sql)) {
				  echo "address updated successfully\n";
				  $address_update = true;
				} else {
				  echo "Error updating record: " . mysqli_error($conn) . "\n";
				}
			}
			
			if ($city != $new_city && !empty($new_city)) {
				$sql = "UPDATE bbb_user SET city = '" . $new_city . "' WHERE username = '" . $username . "'";
				
				if (mysqli_query($conn, $sql)) {
				  echo "city updated successfully\n";
				  $city_update = true;
				} else {
				  echo "Error updating record: " . mysqli_error($conn) . "\n";
				}
			}
			
			if ($state != $new_state && !empty($new_state)) {
				$sql = "UPDATE bbb_user SET state = '" . $new_state . "' WHERE username = '" . $username . "'";
				
				if (mysqli_query($conn, $sql)) {
				  echo "state updated successfully\n";
				  $state_update = true;
				} else {
				  echo "Error updating record: " . mysqli_error($conn) . "\n";
				}
			}
			
			if ($zip != $new_zip && !empty($new_zip)) {
				$sql = "UPDATE bbb_user SET zip = '" . $new_zip . "' WHERE username = '" . $username . "'";
				
				if (mysqli_query($conn, $sql)) {
				  echo "zip updated successfully\n";
				  $zip_update = true;
				} else {
				  echo "Error updating record: " . mysqli_error($conn) . "\n";
				}
			}
			
			if (!empty($new_credit_card) && !empty($new_card_number) && !empty($new_expiration)) {
				$sql = "UPDATE CREDIT_CARD SET card_number =".$new_card_number.", card_type = '". $new_credit_card . "', expiration = '". $new_expiration . "' WHERE username = '". $username . "'";

				if (mysqli_query($conn, $sql)) {
				  echo "Credit Card updated successfully";
				  $cc_update = true;
				} else {
				  echo "Error updating record: " . mysqli_error($conn) . "\n";
				}
			}
			
			$alertStr = "The following fields were updated: ";
			if ($pin_update === true || $fname_update === true || $lname_update === true || $address_update === true || $city_update === true || $state_update === true || $zip_update === true || $cc_update === true ) {
				if ($pin_update === true)
					$alertStr = $alertStr . "   PIN";
				if ($fname_update === true)
					$alertStr = $alertStr . "   First Name";
				if ($lname_update === true)
					$alertStr = $alertStr . "   Last Name";
				if ($address_update === true)
					$alertStr = $alertStr . "   Address";
				if ($city_update === true)
					$alertStr = $alertStr . "   City";
				if ($state_update === true)
					$alertStr = $alertStr . "   State";
				if ($zip_update === true)
					$alertStr = $alertStr . "   ZIP";
				if ($cc_update === true)
					$alertStr = $alertStr . "   Credit Card Information";
			} else {
				$alertStr = "No fields were updated.";
			}
			echo '<script>alert("' . $alertStr . '")</script>'; 
			echo '<script>window.location.href="screen2.php"</script>';
		}

		$conn->close();
	?>

	
	<table align="center" style="border:2px solid blue;">
		<form id="update_profile" action="" method="post">
			<tr>
				<td  align="right">
					Username: 
				</td>
				<td colspan="3" id="username" align="left">
					
				</td>
			</tr>
			<tr>
				<td align="right">
					New PIN<span style="color:red">*</span>:
				</td>
				<td>
					<input type="password" id="new_pin" name="new_pin">
				</td>
				<td align="right">
					Re-type New PIN<span style="color:red">*</span>:
				</td>
				<td>
					<input type="password" id="retypenew_pin" name="retypenew_pin">
				</td>
			</tr>
			<tr>
				<td align="right">
					First Name<span style="color:red">*</span>:
				</td>
				<td colspan="3">
					<input type="text" id="firstname" name="firstname">
				</td>
			</tr>
			<tr>
				<td align="right"> 
					Last Name<span style="color:red">*</span>:
				</td>
				<td colspan="3">
					<input type="text" id="lastname" name="lastname">
				</td>
			</tr>
			<tr>
				<td align="right">
					Address<span style="color:red">*</span>:
				</td>
				<td colspan="3">
					<input type="text" id="address" name="address">
				</td>
			</tr>
			<tr>
				<td align="right">
					City<span style="color:red">*</span>:
				</td>
				<td colspan="3">
					<input type="text" id="city" name="city">
				</td>
			</tr>
			<tr>
				<td align="right">
					State<span style="color:red">*</span>:
				</td>
				<td>
					<select id="state" name="state">
					<option selected disabled>select a state</option>
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
				<td>
					<input type="text" id="zip" name="zip">
				</td>
			</tr>
			<tr>
				<td align="right">
					Credit Card<span style="color:red">*</span>:
				</td>
				<td>
					<select id="credit_card" name="credit_card">
					<option selected>VISA</option>
					<option>MASTER</option>
					<option>DISCOVER</option>
					</select>
				</td>
				<td align="left" colspan="2">
					<input type="text" id="card_number" name="card_number" placeholder="Credit Card Number">
				</td>
			</tr>
			<tr>
				<td align="right" colspan="2">
					Expiration Date<span style="color:red">*</span>:
				</td>
				<td colspan="2" align="left">
					<input type="text" id="expiration_date" name="expiration_date" placeholder="MM/YY">
				</td>
			</tr>
			<tr>
				<td align="right" colspan="2">
					<input type="submit" id="update_submit" name="update_submit" value="Update">
				</td>
		</form>
		<form id="cancel" action="index.php" method="post">	
			<td align="left" colspan="2">
					<input type="submit" id="cancel_submit" name="cancel_submit" value="Cancel">
				</td>
			</tr>
		</form>
	</table>
	
</body>
</html>