<?php
  // Turn on the Session for this page
  session_start();

  // Include Database stuff
  include("common.php");
  db_open();
  $con = $link;

  // Making a flag variable because I don't want to make a global here.
  $error = FALSE;

  // If there is POST info coming to this page, then
  if ($_POST) {
    // Store the username from POST in a session variable
    $_SESSION["Index_Data"]["username"] = $_POST["username"];

    // Check if the data matches in the database for a user

    // Escape the username in case it contains an SQL injection
    $username = mysqli_real_escape_string($con, $_POST["username"]);
    // Hash the password. NEVER STORE PLAIN TEXT PASSWORDS
    $password = hash("sha256", $_POST["password"]);

    // Generate the SQL statement for selecting specific user info.
    $sql = "SELECT *
            FROM User
            WHERE username='$username' AND password='$password'";

    // Run the query, if it doesn't return ANYTHING die.
    if (!($result = mysqli_query($con, $sql))) {
      die("An error has occured: " . mysqli_error($con))
    }
    // If rows, go to next page, if not, turn on error flag
    if (mysqli_num_rows($result)) {
      header("Location: home.php");
    } else {
      $error = TRUE;
    }
  }
  // Include our premade top of the page
  include("header.php");

?>
<div>
  <!-- THIS IS PSUEDO HTML AND IS NOT MEANT TO WORK OR LOOK PRETTY -->
  <?= $error ? "<p>The information you have entered is incorrect.</p>" : "" ?>
  <input type="text" name="username">
  <input type="password" name="password">


<?php
  db_close();
  // Include our premade bottom of the page
  include("footer.php");
?>
