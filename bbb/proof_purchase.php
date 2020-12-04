<?php
	include_once 'connect_to_database.php';
	//TODO:
	//update sold status -- left out for testing
?>
<?php
	// Start the session
	session_start();
	echo $_SESSION["user"];

	// Set time zone
	date_default_timezone_set("America/Detroit");

	// Check if page came from checkout screen
	if($_SERVER['HTTP_REFERER'] == "http://localhost/COSC-471-Project/bbb/confirm_order.php?quan=quan&checkout_submit=Proceed+to+Checkout") {
		// Check if credit card updated
		$new = $_POST["cardgroup"];
		if($new == "new_card") {
			$credit_card = $_POST["credit_card"];
			$card_number = $_POST["card_number"];
			$card_expiration = $_POST["card_expiration"];

			$sql_query = "UPDATE credit_card SET card_number='$card_number', card_type='$credit_card', expiration='$card_expiration' WHERE username='" . $_SESSION["user"] . "';"; 
			$mysqli_result = $conn->query($sql_query); 
		}
	}

	// Pull customer info from DB
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
	<title>Proof purchase</title>
	<header align="center">Proof purchase</header> 
	<style>
		/* Prints the entirety of the div separately below the other order details! */
		@media print {
		    .myDivToPrint {
		        background-color: white;
		        height: 100%;
		        width: 100%;
		        position: fixed;
		        top: 45%;
		        left: 13%;
		        margin: 0;
		        padding: 15px;
		        font-size: 14px;
		        line-height: 18px;
	    	}
		}
	</style>
</head>
<body>
	<table align="center" style="border:2px solid blue;">
	<form id="buy" action="" method="post">
	<tr>
	<td>
	Shipping Address:
	</td>
	</tr>
	<td colspan="2">
		<?php echo $FName . "&nbsp;" . $LName?>	
		<?php echo "<br>" . $address; ?>
		<?php echo "<br>" . $city; ?>	
		<?php echo "<br>" . $state . ", " . $zip; ?>
		</td>
	<td rowspan="3" colspan="2">
		<b>UserID: </b><?php echo $username; ?>	<br />
		<b>Date: </b><?php echo date("Y-m-d"); ?><br />
		<b>Time: </b><?php echo date("h:i:sa"); ?><br />
		<b>Card Info: </b><?php echo $card_type; ?><br /><?php echo $expiration . " - " . $card_number; ?></td>
	<tr>
	<td colspan="2"></td>		
	</tr>
	<tr>
	<td colspan="2"></td>
	</tr>
	<tr>
	<td colspan="3" align="center">
	<div class="myDivToPrint" id="bookdetails" style="overflow:scroll;height:180px;width:520px;border:1px solid black;">
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

			/* PLACE UPDATE, SOLD=1 QUERY HERE */
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
			<input type="submit" id="buyit" name="btnbuyit" value="Print" enabled onClick="window.print()">
		</td>
		</form>
		<td align="right">
			<form id="update" action="screen2.php" method="post">
			<input type="submit" id="update_customerprofile" name="update_customerprofile" value="New Search">
			</form>
		</td>
		<td align="left">
			<form id="cancel" action="index.php" method="post">
			<input type="submit" id="exit" name="exit" value="EXIT 3-B.com">
			</form>
		</td>
	</tr>
	</table>
</body>
</HTML>
