
<?php
	include_once 'connect_to_database.php';
?>
<?php
	// Start the session
	session_start();
	echo $_SESSION["user"];


?>
<!--
	2. Quantity is not being updated (currently hardcoded)
-->
<!DOCTYPE HTML>
<head>
	<title>Shopping Cart</title>
	<script>
	//remove from cart
	function del(isbn){
		window.location.href="shopping_cart.php?delIsbn="+ isbn;
	}

	//2. TODO
	function url(sale_id, quantity, isbn){
		console.log(sale_id);
		console.log(isbn);
		console.log(quantity);
		//var q = document.getElementById("sale_id").value;
		// console.log(q);
		window.location.href="shopping_cart.php?sale_id="+ sale_id + "&quantity=" + quantity + "&isbn=" + isbn;
		// alert("hi");
	}
	</script>
</head>
<body>

	<table align="center" style="border:2px solid blue;">
		<tr>
			<td align="center">
				<form id="checkout" action="confirm_order.php" method="get">
										<input type="hidden" name="quan" value="quan">
					<input type="submit" name="checkout_submit" id="checkout_submit" value="Proceed to Checkout">
				</form>
			</td>
			<td align="center">
				<form id="new_search" action="screen2.php" method="post">
					<input type="submit" name="search" id="search" value="New Search">
				</form>								
			</td>
			<td align="center">
				<form id="exit" action="index.php" method="post">
					<input type="submit" name="exit" id="exit" value="EXIT 3-B.com">
				</form>					
			</td>
		</tr>
		<tr>
				<form id="recalculate" name="recalculate" action="" method="post">
			<td  colspan="3">
				<div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;">
					<table align="center" BORDER="2" CELLPADDING="2" CELLSPACING="2" WIDTH="100%">
						<th width='10%'>Remove</th>
						<th width='60%'>Book Description</th>
						<th width='10%'>Qty</th>
						<th width='10%'>Price</th>

						<?php
							//Update quantity in db
							function urlFun($conn, $sale_id, $quantity, $isbn) {
								$quantity_query = "UPDATE SALE
										SET quantity='$quantity'
										WHERE sale_id='$sale_id' AND ISBN='$isbn';";
								mysqli_query($conn, $quantity_query);
							}

							//Delete
							function delete($conn, $sale_id, $isbn) {
								$SQL = "DELETE FROM SALE WHERE sale_id='$sale_id' AND ISBN='$isbn';";
								mysqli_query($conn, $SQL);
							}

							//TODO: if quantity changed, update db
							

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



									if (isset($_POST['isbn'])) {
										$quantity = $_POST['isbn'];
										urlFun($conn, $sale_id, $quantity, $isbn);
									}
								
									echo "<tr><td><button name='delete' id='delete' onClick='del(" . $isbn . ");return false;'>Delete Item</button></td>";
									echo "<td>" . $title . "</br><b>By</b> " . $author . "</br><b>Publisher:</b> " . $publisher . "</td>";
									echo "<td><input id='" . $sale_id . "' name='" . $isbn . "' value='" . $quantity . "' size='1' onchange='url(" . $sale_id . ", " . $quantity . ", " . $isbn . ");'/></td>";
									echo "<td>" . $price . "</td>";
									echo "</tr>";
									// echo "<p>" . $sale_id . "</p>";
									
									if (isset($_POST['delIsbn'])) {
										$isbn = $_POST['delIsbn'];
										delete($conn, $sale_id, $isbn);
									}

									
								}
							}
						?>
						</table>
				</div>
			</td>
		</tr>
		<tr>
			<td align="center">				
				<input type='submit' name='recalculate_payment' id='recalculate_payment' value='Recalculate Payment'>
				</form>
			</td>
			<td align="center">
				&nbsp;
			</td>
			<td align="center">
				<?php
					//Calculate; for each book: subtotal += quantity*price
					$sql_query = "SELECT * FROM SALE NATURAL JOIN BOOK WHERE sold=0 AND username='" . $_SESSION["user"] . "';";
					$mysqli_result = $conn->query($sql_query); 
					
					$sum = 0;
					if(mysqli_num_rows($mysqli_result) > 0 ){
						while($row = mysqli_fetch_array($mysqli_result)) {
							$quantity = $row['quantity'];
							$price = $row['price'];

							$sum += $quantity * $price;
						}
					}
					echo "Subtotal: $" . $sum;

					//$conn->close();
				?>

			</td>
		</tr>
	</table>

</body>
