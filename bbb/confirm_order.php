<?php
	include_once 'connect_to_database.php';
?>
<?php
	// Start the session
	session_start();
	echo $_SESSION["user"];

	$sql_query = "SELECT * FROM SALE NATURAL JOIN BBB_USER NATURAL JOIN credit_card WHERE sold=0 AND username='" . $_SESSION["user"] . "';"; 
	$mysqli_result = $conn->query($sql_query); 
	

	if(mysqli_num_rows($mysqli_result) > 0 ){
		while($row = mysqli_fetch_array($mysqli_result)) {
			$username = $row['username'];
			$sale_id = $row['sale_id']; // ""
			$quantity = $row['quantity']; // ""
			$ISBN = $row['ISBN']; // NEED TO LOOP AGAIN LATER
			$FName = $row['FName'];
			$LName = $row['LName'];
			$address = $row['address'];
			$city = $row['city'];
			$state = $row['state'];
			$zip = $row['ZIP'];
			$card_number = $row['card_number'];
			$card_type = $row['card_type'];
			$expiration = $row['expiration'];
		}
	}
?>
<!DOCTYPE HTML>
<head>
	<title>CONFIRM ORDER</title>
	<header align="center">Confirm Order</header> 
</head>
<body>
	<table align="center" style="border:2px solid blue;">
	<form id="buy" action="proof_purchase.php" method="post">
	<tr>
	<td>
	<span style="font-weight: bold";> Shipping Address: </span>
	</td>
	</tr>
	<td colspan="2">
		<?php echo $FName . "&nbsp;" . $LName?>	
		<?php echo "<br>" . $address; ?>
		<?php echo "<br>" . $city; ?>	
		<?php echo "<br>" . $state . ", " . $zip; ?>
		</td>
	<td rowspan="3" colspan="2">
		<input type="radio" name="cardgroup" value="profile_card" checked>Use Credit card on file<br /><?php echo $card_type . " - " . $card_number . " - " . $expiration; ?><br />
		<input type="radio" name="cardgroup" value="new_card">New Credit Card<br />
				<select id="credit_card" name="credit_card">
					<option selected disabled>select a card type</option>
					<option>VISA</option>
					<option>MASTER</option>
					<option>DISCOVER</option>
				</select>
				<input type="text" id="card_number" name="card_number" placeholder="Credit card number">
				<br />Exp date<input type="text" id="card_expiration" name="card_expiration" placeholder="mm/yyyy">
	</td>
	<tr>
	<tr>
	<td colspan="2"></td>
	</tr>
	<tr>
	<td colspan="2"></td>
	</tr>
	<tr>
	<td colspan="3" align="center">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:520px;border:1px solid black;">
	<table border='1'>
		<th>Book Description</th>
		<th>Qty</th>
		<th>Price</th>
		<?php
			$sql_query = "SELECT * FROM SALE NATURAL JOIN BOOK WHERE sold=0 AND username='" . $_SESSION["user"] . "';"; 
			$mysqli_result = $conn->query($sql_query); 
			

			if(mysqli_num_rows($mysqli_result) > 0 ){
				while($row = mysqli_fetch_array($mysqli_result)) {
					$isbn = $row['ISBN'];
					$title = $row['title'];
					$author = $row['author'];
					$publisher = $row['publisher'];
					$quantity = $row['quantity'];
					$price = $row['price'];
					$sale_id = $row['sale_id'];
				
					echo "<tr>";
					echo "<td>" . $title . "</br><b>By</b> " . $author . "</br><b>Publisher:</b> " . $publisher . "</td>";
					echo "<td style='text-align:center'>" . $quantity . "</td>";
					echo "<td>" . $price . "</td>";
					echo "</tr>";
				}
			}
		?>
	</table>
	</div>
	</td>
	</tr>
	<tr>
	<td align="left" colspan="2">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:260px;border:1px solid black;background-color:LightBlue">
	<b>Shipping Note:</b> The book(s) will be </br>delivered within 5</br>business days.
	</div>
	</td>
	<td align="right">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:260px;border:1px solid black;">
		<?php
			//Calculate; for each book: subtotal += quantity*price
			$sql_query = "SELECT * FROM SALE NATURAL JOIN BOOK WHERE sold=0 AND username='" . $_SESSION["user"] . "';";
			$mysqli_result = $conn->query($sql_query); 
			
			$sum = 0;
			$shipping = 0;
			if(mysqli_num_rows($mysqli_result) > 0 ){
				while($row = mysqli_fetch_array($mysqli_result)) {
					$quantity = $row['quantity'];
					$price = $row['price'];

					$sum += $quantity * $price;
					$shipping += 2 * $quantity;
				}
			}
			echo "Subtotal: $" . $sum;
			echo "</br>Shipping_Handling: $" . $shipping;
			echo "</br>_______</br>Total: $" . ($sum + $shipping);

			//$conn->close();
		?>
	</div>
	</td>
	</tr>
	<tr>
		<td align="right">
			<input type="submit" id="buyit" name="btnbuyit" value="BUY IT!">
		</td>
		</form>
		<td align="right">
			<form id="update" action="update_customerprofile.php" method="post">
			<input type="submit" id="update_customerprofile" name="update_customerprofile" value="Update Customer Profile">
			</form>
		</td>
		<td align="left">
			<form id="cancel" action="index.php" method="post">
			<input type="submit" id="cancel" name="cancel" value="Cancel">
			</form>
		</td>
	</tr>
	</table>
</body>
</HTML>
