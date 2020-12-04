<?php
	include_once 'connect_to_database.php';
?>
<?php
	// Start the session
	session_start();
	if(!isset($_POST['username']))
	{
	    $_SESSION["user"] = $_POST["username"];
	}
	
	echo $_SESSION["user"];
?>


<!-- Figure 2: Search Screen by Alexander -->
<html>
<head>
	<title>SEARCH - 3-B.com</title>
	<script>
		function success() {
			if(document.getElementById('myText').value==="") { 
				document.getElementById('start_button').disabled = true; 
			} else { 
				document.getElementById('start_button').disabled = false;
			}
		}
		//This function adds the keywords and options to URL of screen3.php
		function results(){


			
			
			//Set category string
			var c = document.getElementById("category");
			var category = "";
			if (c.options[c.selectedIndex].text === "All Categories")
				category = "all";
			else 
				category = c.options[c.selectedIndex].text;
			
			//Set keyworkds
			var keywords = document.getElementById("myText").value;
			var keys = keywords.split(",").map(function(item) {
				return item.trim();
			});
			var keystr = "";
			for (i = 0; i < keys.length; i++) {
				keystr = keystr + "&keyword" + (i+1).toString() + "=" + keys[i];
			}
			
			//Select attributes string
			var searchon = Array.prototype.slice.call(document.querySelectorAll('#searchOn option:checked'), 0).map(function(v,i,a) {
				return v.value;
			});
			var attstr = "";
			for (i = 0; i < searchon.length; i++) {
				attstr = attstr + "&att" + (i+1).toString() + "=" + searchon[i].toString();
			}
			
			//Set URL for screen3.php
			window.location.href="screen3.php?category=" + category + attstr + keystr;
		}
	</script>
</head>
<body>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td>Search for: </td>
			<form id = "screen3-btn" action="screen3.php" method="get">
				<td><input  id="myText" type="text" onkeyup="success()" name="searchfor"/></td>
				<td><input type="button" name="search" id = "start_button" value="Search" onclick = "results('Education')" disabled/></td>
		</tr>
		<tr>
			<td>Search In: </td>
				<td>
					<select id="searchOn" multiple>
						<option value="anywhere" selected='selected'>Keyword anywhere</option>
						<option value="title">Title</option>
						<option value="author">Author</option>
						<option value="publisher">Publisher</option>
						<option value="isbn">ISBN</option>				
					</select>
				</td>
				<td><a href="shopping_cart.php"><input type="button" name="manage" value="Manage Shopping Cart" /></a></td>
		</tr>
		<tr>
			<td>Category: </td>
				<td><select id="category">
						<option value='all' selected='selected'>All Categories</option>
							<?php
								
								$categories = "SELECT DISTINCT category FROM book";
								$result = mysqli_query($conn, $categories);	
								if (mysqli_num_rows($result) > 0) {
									while ($row = mysqli_fetch_assoc($result)) {
										echo "<option value='".$row."'>".$row['category']."</option>";
									}
								}
							?>
						<</select></td>
				</form>
	<form action="index.php" method="post">	
				<td><input type="submit" name="exit" value="EXIT 3-B.com" /></td>
			</form>
		</tr>
	</table>
</body>
</html>
