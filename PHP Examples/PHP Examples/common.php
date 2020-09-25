<?php
  //database attributes
  $db_server = "db2.emich.edu";
  $db_username = "myGivenUsername";
  $db_password = "myGivenPassword";
  $db_name = "myGivenDBName";

  //Open a connection
  function db_open()  {
    global $link, $db_server, $db_name, $db_username, $db_password;
    $link = @mysqli_connect($db_server, $db_username, $db_password, $db_name)
                or  die("Could not connect: " . mysqli_connect_error());
  }

  //Close a connection
  function db_close() {
    global $link;
    @mysqli_close($link);
  }

  /*
    The @ symbol suppresses error messages generated by functions.
    We use them here so that our private infomation is not displayed to a user
    if an error were to occur.

    The global keyword is used so that our variables can be accessed outside of
    the function. Mostly for $link
  */


?>
