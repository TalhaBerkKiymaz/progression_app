<?php
 include("./connect_db.php");

 include("./functions.php");

$id = sanitize($_POST["id"]);
$lessons = sanitize($_POST["lessons"]);
$description = sanitize($_POST["description"]);
$ddline_date = $_POST["deadline"];
$date = date("Y-m-d", strtotime($ddline_date));


$query = "INSERT INTO `assigments` (`id`, `lessons`, `description`, `ddline_date`) VALUES ('$id', '$lessons', '$description', '$date')";
// echo $query; exit ();

mysqli_query($conn, $query); 

header("Location: ./index.php?content=assigment");

?>