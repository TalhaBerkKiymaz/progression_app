<?php
  include("./functions.php");
  is_authorized(["admin",]);
?>



a-home
<?php
  echo "Mijn gebruikersrol is: " . $_SESSION["userrole"];
  echo "<hr>";
  echo "Mijn id is: " . $_SESSION["user_id"];
?>
