

<?php
	include_once 'connect_to_database.php';
?>
<?php

	//TODO:
	// Add sale total to db info
	// Get sale total and generate report

	// Start the session
	session_start();
	echo $_SESSION["user"];

	// Num customers
	$sql_query = "SELECT COUNT(username) AS total from bbb_user where username != 'admin';";
	$mysqli_result = $conn->query($sql_query);
	if(mysqli_num_rows($mysqli_result) > 0 ){
		while($row = mysqli_fetch_array($mysqli_result)) {
			$total = $row['total'];
		}
	}

	// Book categories
	$sql_query = "SELECT COUNT(ISBN) AS total FROM book WHERE category='Education';";
	$mysqli_result = $conn->query($sql_query);
	if(mysqli_num_rows($mysqli_result) > 0 ){
		while($row = mysqli_fetch_array($mysqli_result)) {
			$totalEd = $row['total'];
		}
	}

	$sql_query = "SELECT COUNT(ISBN) AS total FROM book WHERE category='Fiction';";
	$mysqli_result = $conn->query($sql_query);
	if(mysqli_num_rows($mysqli_result) > 0 ){
		while($row = mysqli_fetch_array($mysqli_result)) {
			$totalFi = $row['total'];
		}
	}

	$sql_query = "SELECT COUNT(ISBN) AS total FROM book WHERE category='Horror';";
	$mysqli_result = $conn->query($sql_query);
	if(mysqli_num_rows($mysqli_result) > 0 ){
		while($row = mysqli_fetch_array($mysqli_result)) {
			$totalHo = $row['total'];
		}
	}


	
?>


<!DOCTYPE HTML>
<head>
	<title>ADMIN TASKS</title>
</head>
<body>
	<table align="center" style="border:2px solid blue;">
		<tr>
			<td> Registered customers: <?php echo $total ?></td>
		</tr>
		<tr>
			<td> <br>Education book titles: <?php echo $totalEd ?> </td>
		</tr>
		<tr>
			<td>Fiction book titles: <?php echo $totalFi ?> </td>
		</tr>
		<tr>
			<td>Horror book titles: <?php echo $totalHo ?> </td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td>Average monthly sales for <?php echo date("Y") ?> : <br></td>
		</tr>


		<?php
			// Avg monthly sales
			$sql_query = "SELECT * FROM sale NATURAL JOIN book WHERE sold=1 ORDER BY month;";
			$mysqli_result = $conn->query($sql_query);
			if(mysqli_num_rows($mysqli_result) > 0 ){
				while($row = mysqli_fetch_array($mysqli_result)) {
					$ISBN = $row['ISBN'];
					$quantity = $row['quantity'];
					$month = $row['month'];
					$sale_year = $row['sale_year'];
					$price = $row['price'];



					$avg = $quantity * $price;

					echo "<tr>";
					echo "<br>";
					echo "<td>" . $month . ": $" . $avg . "<br>";
					echo "</td><tr>";
				}
			}
		?>
		<?php
			// Books, reviews
			$sql_query = "SELECT * FROM book;";
			$mysqli_result = $conn->query($sql_query);
			if(mysqli_num_rows($mysqli_result) > 0 ){
				while($row = mysqli_fetch_array($mysqli_result)) {
					$title = $row['title'];
					$ISBN = $row['ISBN'];

					$sql_query2 = "SELECT COUNT(review_id) AS total FROM review WHERE ISBN='$ISBN';";
					$mysqli_result2 = $conn->query($sql_query2);
					if(mysqli_num_rows($mysqli_result2) > 0 ){
						while($row = mysqli_fetch_array($mysqli_result2)) {
							$total = $row['total'];

							echo "<tr><td>&nbsp;</td></tr>";
							echo "<tr>";
							echo "<br>";
							echo "<td> Title: " . $title . "<br>ISBN: " . $ISBN . "<br>Reviews: " . $total . "<br>";
							echo "</td><tr>";
						}
					}
				}
			}
		?>
		<tr>
		<td>&nbsp</td>
		</tr>
		<tr>
			<form action="index.php" method="post" id="exit">
			<td align="center">
				<input type="submit" name="cancel" id="cancel" value="EXIT 3-B.com[Admin]" style="width:200px;">
			</td>
			</form>
		</tr>
	</table>
</body>


</html>