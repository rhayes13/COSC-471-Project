<?php
  // Turn on the Session for this page
  session_start();

  // If there is no record of a current user, send them to the index page
  if (empty($_SESSION["Index_Data"]["username"])) {
    header("Location: index.php");
  }

  // Include database stuff
  include("common.php");
  db_open();
  $con = $link;

  // Another variable I want to make here
  $array;

  if ($_POST) {
    // Make sure all data going to the database is clean.
    // I ignore integer for a naive reason
    $integer = $_POST["integer"];
    $name = mysqli_real_escape_string($con, $_POST["name"]);
    $value = mysqli_real_escape_string($con, $_POST["value"]);

    $sql = "INSERT INTO Table (name, num, value)
            VALUES '$name', $integer, '$value'";

    // If the query doesn't return anything, die.
    if (!($result = mysqli_query($con, $sql))) {
      die("An Error has occurred: " . mysqli_error($con));
    }

    // So I can show how to fetch data from a call, retrieve all usernames kinda matching name
    $sql = "SELECT username
            FROM User
            WHERE username='%$name%'";

    if (!($result = mysqli_query($con, $sql))) {
      die("An Error has occurred: " . mysqli_error($con));
    }

    // While there is a row in the query...
    while ($row = mysqli_fetch_assoc($result)) {
      // ...push the value into another array.
      $array[] = $row["username"];
    }

    // Now we have an array of all of the usernames like name.

  }



  // Include the premade top of our page
  include("header.php");
?>
<!-- THIS IS PSUEDO HTML AND IS NOT MEANT TO WORK OR LOOK PRETTY -->
<div>
  <form>
    <input type="text" name="name">
    <input type="text" name="value">
    <select name="integer">
      <?php
      // Generate 10 options using a php loop
        for ($i=0; $i < 10; $i++) {
          // Print HTML out
          echo "<option value=" . $i . ">" . $i . "</option>";
        }
      ?>
    </select>
    <button type="submit">Submit</button>
  </form>
</div>

<?php
  db_close();
  // Include the premade bottom of our page
  include("footer.php");
?>
