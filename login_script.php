<?php
var_dump($_POST);
include("./connect_db.php");
include("./functions.php");

$email = sanitize($_POST["email"]);
$password = sanitize($_POST["password"]);

if (empty($email) || empty($password)) {
  // Check of de loginformvelden zijn ingevuld...
  header("Location: ./index.php?content=message&alert=loginform-empty");
} else {

  $sql = "SELECT * FROM `register` WHERE `email` = '$email'";

  $result = mysqli_query($conn, $sql);

  // echo $result;exit();
  // var_dump((bool) mysqli_num_rows($result));

  if (!mysqli_num_rows($result)) {
    // E-mailadres onbekend...
    header("Location: ./index.php?content=message&alert=email-unknown");
  } else {

    $record = mysqli_fetch_assoc($result);

    // var_dump((bool) $record["activated"]);

    if (!$record["activated"]) {
      // Not activated
      header("Location: ./index.php?content=message&alert=not-activated&email=$email");
    } elseif (!password_verify($password, $record["password"])) {
      // No password match
      header("Location: ./index.php?content=message&alert=no-pw-match&email=$email");
    } else {
      // password matched
     
      $_SESSION["user_id"] = $record["user_id"];
      $_SESSION["userrole"] = $record["userrole"];
      
      // echo$record["user_id"];exit();
      // echo$record["userrole"];exit();
      switch ($record["userrole"]) {
        case 'teacher':
          header("Location: ./index.php?content=t-home");
          break;
        case 'admin':
          header("Location: ./index.php?content=a-home");
          break;
        case 'director':
          header("Location: ./index.php?content=d-home");
          break;
        case 'student':
          header("Location: ./index.php?content=s-home");
          break;
        default:
          header("Location: ./index.php?content=home");
          break;
      }
    }
  } // E-mailadres onbekend...
} // Check of de loginformvelden zijn ingevuld...
