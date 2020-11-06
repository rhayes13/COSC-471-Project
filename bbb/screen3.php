<?php
	include_once 'connect_to_database.php';
?>

<html>
<head>
	<title> Search Result - 3-B.com </title>
	<script>
	//redirect to reviews page
	function review(isbn, title){
		window.location.href="screen4.php?isbn="+ isbn;
	}
	//add to cart
	function cart(sale_id, quantity, month, sale_year, sold, username, isbn){
		window.location.href="screen3.php?sale_id="+ sale_id + "&quantity=" + quantity + "&month=" 
		+ month + "&sale_year=" + sale_year + "&sold=" + sold + "&username=" + username + "&isbn=" + isbn;
	}
	</script>
	
</head>
<body>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td align="left">
				
					<h6> <fieldset>Your Shopping Cart has 0 items</fieldset> </h6>
				
			</td>
			<td>
				&nbsp
			</td>
			<td align="right">
				<form action="shopping_cart.php" method="post">
					<input type="submit" value="Manage Shopping Cart">
				</form>
			</td>
		</tr>	
		<tr>
		<td style="width: 350px" colspan="3" align="center">
			<div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;background-color:LightBlue">
				<table>
					<?php							
							$books = "SELECT * FROM book;";
							$result = mysqli_query($conn, $books);						
							
							// UPDATE THIS FUNCTION SO THAT CURRENT USER IS SELECTED
							// NOT FUNCTIONAL YET
							function insertToCart($conn, $sale_id, $quantity, $month,$sale_year, $sold, $username, $isbn) {
								$SQL = "INSERT INTO sale (sale_id,  quantity, month, sale_year, sold, username, isbn) 
									VALUES (".$sale_id.",
											".$quantity.",
											'".$month."',
											".$sale_year.",
											".$sold.", 
											'".$username."',
											'".$isbn."')";
								mysqli_query($conn, $SQL);
							}
							
							
							if (mysqli_num_rows($result) > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
									
									echo "<tr><td align='left'>";
									echo "<button name='btnCart' id='btnCart' onClick='cart(4, 1, \"May\", 2014, 0, \"joe\", \"72227885\")'>Add to Cart</button></td>";
									echo "<td rowspan='2' align='left'>" . $row['title'].  "</br>" . $row['author']. "</br>";
									echo "<b>Publisher:</b> " . $row['publisher']. ",</br>";
									echo "<b>ISBN:</b> " . $row['ISBN']. "</t> <b>Price:</b> " . $row['price']. "</td></tr>";
									echo "<tr><td align='left'><button name='review' id='review' onClick='review(\"" . $row['ISBN']. "\")'>Reviews</button></td></tr>";
									echo "<tr><td colspan='2'><p>_______________________________________________</p></td></tr>";
										
									if (isset($_GET['sale_id'])) {
										$sale_id = $_GET['sale_id'];
										$quantity = $_GET['quantity'];
										$month = $_GET['month'];
										$sale_year = $_GET['sale_year'];
										$sold = $_GET['sold'];
										$username = $_GET['username'];
										$isbn = $_GET['isbn'];
																				
										insertToCart($conn, $sale_id, $quantity, $month,$sale_year, $sold, $username, $isbn);
									}
								}
							}
					?>
				</table>
			</div>
			
			</td>
		</tr>
		<tr>
			<td align= "center">
				<form action="confirm_order.php" method="get">
					<input type="submit" value="Proceed To Checkout" id="checkout" name="checkout">
				</form>
			</td>
			<td align="center">
				<form action="screen2.php" method="post">
					<input type="submit" value="New Search">
				</form>
			</td>
			<td align="center">
				<form action="index.php" method="post">
					<input type="submit" name="exit" value="EXIT 3-B.com">
				</form>
			</td>
		</tr>
	</table>
</body>
</html>
