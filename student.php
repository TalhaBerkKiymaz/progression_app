<?php

/**
 * Omschrijving: Deze pagina geeft alle studenten weer die gekoppeld zijn aan een klas.
 * Afhankelijk van: student    
 */
$class_name = $_GET["class"];
$lessons = $_GET["lesson"];
// Dit is voor editen en verwijderen van rijjen
//     <td>
//         <a href='./index.php?content=update_users&id='  ''>
//             <img src='./img/icons/b_edit.png' alt=; pencil'>
//         </a>
//     </td>
//     <td>
//     <a href='./index.php?content=delete_users&id='  ''>
//         <img src='./img/icons/b_drop.png' alt=; cross'>
//     </a>
// </td>

include("./connect_db.php");

$sql = "SELECT
       `course`.`course_name`, s.class_name, `course`.`lessons`, s.student_id, s.firstname, s.infix, s.lastname 
       from class_course as cc, class as c, student as s, course 
       where `course`.`lessons` = '" . $lessons  . "'
       and s.`class_name` = '" . $class_name  . "' 
       GROUP BY s.student_id";

// echo$sql;exit();
$result = mysqli_query($conn, $sql);
// var_dump($result);
$show = "<div class='row'>";
while ($record = mysqli_fetch_assoc($result)) {
  $show .= "
  <tr>
    <th scope='row'> {$record['student_id']} </th>
    <td> {$record['firstname']} </td>
    <td> {$record['infix']} </td>
    <td> {$record['lastname']} </td>
    <td> <select>
          <option value='1'>1</option>
          <option value='2'>2</option>
          <option value='3'>3</option>
          <option value='4'>4</option>
          <option value='5'>5</option>
          <option value='6'>6</option>
          <option value='7'>7</option>
          <option value='8'>8</option>
          <option value='9'>9</option>
          <option value='10'>10</option>
          

          </select>
    </td>
</tr>";

  // var_dump($record);

}

mysqli_data_seek($result,0);
$record = mysqli_fetch_assoc($result);
// echo "============================";
// var_dump($record);
$course = $record["course_name"];
// var_dump($course);
$show2 = "<div class='container'>";
$show2 .= " 
<h2> $class_name <br> <h4>Vak: $lessons </h4> <h5>Cursus naam: $course </h5>  </h2>";
echo $show2;
// echo $show;
?>


<div class="col-12">
<div>
  
</div>
  <!-- Op deze plek komt de tabel -->
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Naam</th>
        <th scope="col">Tussenvoegsel</th>
        <th scope="col">Achternaam</th>
        <th scope="col">Progressie/Modul</th>
      </tr>
    </thead>
    <tbody>
      <?php
      echo $show;
      ?>
    </tbody>
  </table>
</div>