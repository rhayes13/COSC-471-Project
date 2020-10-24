<?php
	include_once 'connect_to_database.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Book Reviews - 3-B.com</title>
<style>
.field_set
{
	border-style: inset;
	border-width:4px;
	padding:5px;
}

</style>
</head>
<body>
	<?php 
	
	// Test if book is in database
	$isbn = $_GET['isbn'];
	$title = "SELECT * FROM book WHERE ISBN = " . $isbn . ";";
	$result = mysqli_query($conn, $title);
	if (mysqli_num_rows($result) != 0) : ?>
	
		<table align="center" style="border:1px solid blue;padding:10px;">
			<tr>
				<td align="center">
					<h4> Reviews For:</h4>
				</td>
				<td align="left" style="background:#F0F0F0;display:inline-block;padding:3px 7px">
						<?php
							$isbn = $_GET['isbn'];
							
							$title = "SELECT * FROM book WHERE ISBN = " . $isbn . ";";
							$result = mysqli_query($conn, $title);
							
							if (mysqli_num_rows($result) > 0) {
								if ($row = mysqli_fetch_assoc($result)) {
									echo $row['title'];
									
									if (!is_null($row['author'])) {
										echo "<br><b>By </b>" . $row['author'];
									}
								}
							}
						?>
				</td>
			</tr>
				
			<tr>
				<td colspan="2">
				<div id="bookdetails" style="overflow:scroll;height:200px;width:400px;margin:10px;">
				<table style = "border:5px solid #F0F0F0;">	
						<?php
							$sql = "SELECT review FROM review WHERE ISBN = " . $isbn . ";";
							$result = mysqli_query($conn, $sql);
							$resultCheck = mysqli_num_rows($result);
							
							if ($resultCheck > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
									echo "<tr><td class=\"field_set\">" . $row['review'] . "</td></tr>";
								}
							}
						?>
						
							</table>
				</div>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<form action="screen2.php" method="post">
						<input type="submit" value="Done">
					</form>
				</td>
			</tr>
		</table>
	<?php else:
		echo "Error: Book not found.";
	endif; ?>
	
</body>

</html>
