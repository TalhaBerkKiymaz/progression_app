<?php
/**
 * Omschrijving: Deze pagina geeft alle klassen weer die gekoppeld zijn aan een cursus.
 * Afhankelijk van: class_course/lessons    
 */
include("./connect_db.php");


$sql = "SELECT c.student_id, c.firstname, c.infix, c.lastname, cc.lessons, cc.course_name FROM student as c, course as cc group by c.student_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>ID</th><th>Name</th><th>Lessons</th><th>Course Name</th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["student_id"]."</td><td>".$row["firstname"]." ".$row["infix"]." ".$row["lastname"]."</td><td>".$row["lessons"]."</td><td>".$row["course_name"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
$conn->close();
?>