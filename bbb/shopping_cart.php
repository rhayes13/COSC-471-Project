<!DOCTYPE HTML>
<?php
	include_once 'connect_to_database.php';
?>

<head>
	<title>Shopping Cart</title>
	<script>
	//remove from cart
	function del(isbn){
		window.location.href="shopping_cart.php?delIsbn="+ isbn;
	}
	//TODO
	function url(sale_id, quantity, isbn){
		window.location.href="shopping_cart.php?sale_id="+ sale_id + "&quantity=" + quantity + "&isbn=" + isbn;
		alert("hi");
	}
</script>
	</script>
</head>
<body>


	<table align="center" style="border:2px solid blue;">
		<tr>
			<td align="center">
				<form id="checkout" action="confirm_order.php" method="get">
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
						<th width='10%'>Remove</th><th width='60%'>Book Description</th><th width='10%'>Qty</th><th width='10%'>Price</th>
						<tr><td><button name='delete' id='delete' onClick='del("123441");return false;'>Delete Item</button></td><td>iuhdf</br><b>By</b> Avi Silberschatz</br><b>Publisher:</b> McGraw-Hill</td><td><input id='txt123441' name='txt123441' value='1' size='1' /></td><td>12.99</td></tr>					</table>

						<?php
							//TODO
							function urlFun($conn, $sale_id, $quantity, $isbn) {
								$SQL = "UPDATE SALE
										SET quantity=\".$quantity.\"
										WHERE sale_id=\".$sale_id.\" AND ISBN=\".$isbn.\"";
								mysqli_query($conn, $SQL);
							}

							//TODO: delete not working
							function delete($conn, $sale_id, $isbn) {
								$SQL = "DELETE FROM SALE WHERE sale_id=\".$sale_id.\" AND ISBN=\".$isbn.\"";
								mysqli_query($conn, $SQL);
							}

							$sql_query = "SELECT * FROM SALE NATURAL JOIN BOOK WHERE sold=0"; 
							$mysqli_result = $conn->query($sql_query); 


							if(mysqli_num_rows($mysqli_result) > 0 ){
								while($row = mysqli_fetch_array($mysqli_result)) {
									echo "<table align=\"center\" BORDER=\"2\" CELLPADDING=\"2\" CELLSPACING=\"2\" WIDTH=\"100%\">";
									echo "<th width='10%'>Remove</th><th width='60%'>Book Description</th><th width='10%'>Qty</th><th width='10%'>Price</th>";
									echo "<tr><td><button name='delete' id='delete' onClick='del(" . $row['ISBN'] . ");return false;'>Delete Item</button></td>";
									echo "<td>" . $row['title'] . "</br><b>By</b> " . $row['author'] . "</br><b>Publisher:</b> " . $row['publisher'] . "</td><td><input id='txt" . $row['ISBN'] . "' name='txt" . $row['ISBN'] . "' value='" . $row['quantity'] . "' size='1' /></td><td>" . $row['price'] . "</td>";
									echo "</tr>					</table>";



									//TODO
									if (isset($_GET['sale_id'])) {
										$sale_id = $_GET['sale_id'];
										$quantity = $_GET['quantity'];
										$isbn = $_GET['isbn'];

										urlFun($conn, $sale_id, $quantity, $isbn);
									}

									if (isset($_GET['sale_id'])) {
										$sale_id = $_GET['sale_id'];
										$isbn = $_GET['isbn'];

										delete($conn, $sale_id, $isbn);
									}

								}
							}
							

							
						?>
				</div>
			</td>
		</tr>
		<tr>
			<td align="center">				
					<!-- TODO -->
					<?php
						echo "<input type='submit' name='recalculate_payment' id='recalculate_payment' value='Recalculate Payment' onClick='url(4, 2, 72227885);'>";
					?>
				</form>
			</td>
			<td align="center">
				&nbsp;
			</td>
			<td align="center">		<!-- TODO -->	
				Subtotal:  $12.99			</td>
		</tr>
	</table>
	<?php
		$conn->close();
	?>
</body>
