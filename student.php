<?php

/**
 * Omschrijving: Deze pagina geeft alle klassen weer die gekoppeld zijn aan een cursus.
 * Afhankelijk van: class_course/lessons    
 */
$class_name = $_GET["class"];
$lessons = $_GET["lesson"];

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


$sql = "SELECT c.student_id, c.firstname, c.infix, c.lastname, c.class_name, cc.lessons, cc.course_name 
        FROM student as c, course as cc, class_course as s 
        WHERE c.`class_name` = '" . $class_name  . "'
        and s.`lessons` = '" . $lessons  . "'
        GROUP BY c.student_id ";

// echo$sql;exit();
$result = mysqli_query($conn, $sql);

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
          <option value='11'>11</option>
          <option value='12'>12</option>

          </select>
    </td>
</tr>";

  // var_dump($record);



  // var_dump($record);
}


// echo $show;
?>


<div class="col-12">
<div>
  <h2><?php echo $class_name ?></h2>
  <h4><?php echo $lessons ?></h4>
</div>
  <!-- Op deze plek komt de tabel -->
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Naam</th>
        <th scope="col">Tussenvoegsel</th>
        <th scope="col">Achternaam</th>
        <th scope="col">Point</th>
      </tr>
    </thead>
    <tbody>
      <?php
      echo $show;
      ?>
    </tbody>
  </table>
</div>
