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

$sql = "SELECT ass_id, student_id, result, `course`.`course_name`, s.`class_name`, ass.`lessons`
        FROM assigments_points,  students as s, assigments as ass, 
        where ass.`lessons` = '" . $lessons  . "'
        and s.`class_name` = '" . $class_name  . "' 
        GROUP BY s.id";

echo$sql;exit();
$result = mysqli_query($conn, $sql);
// var_dump($result);
$show = "<div class='row'>";
while ($record = mysqli_fetch_assoc($result)) {
  $assigmentid = $record['assigmentid'];
  $pdescription = $record['pdescription'];
  $show .= "
  <tr>
    <th scope='row'> {$record['id']} </th>
    <td> {$record['firstname']} </td>
    <td> {$assigmentid} </td>
    <td> {$record['description']} </td>
    <td> 
          <img src='./img/results/{$record['pointurl']}' title='$pdescription'>
         </td>
    </tr>
    ";

  // var_dump($record);

}

mysqli_data_seek($result, 0);
$record = mysqli_fetch_assoc($result);
// echo "============================";
// var_dump($record);
$course = $record["course_name"];
// var_dump($course);
$show2 = "<div class='container'>";
$show2 .= " <div class='table-cover'>
<div  style='color:whitesmoke;'><h2  style='color:#fed136; '> $class_name - Opdrachten <br><br> <h4>Vak: $lessons </h4> <h5>Cursus naam: $course </h5>  </h2></div>";
echo $show2;
// echo $show;
?>

<div style="padding-top: 25px;">
  <!-- Op deze plek komt de tabel -->
  <form action="./index.php?content=student_points" method="post">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col" ><a style="color: #fed136; text-decoration:none;" href="#">StudentID</a></th>
          <th scope="col">Naam</th>
          <th scope="col">Hoofdstuk</th>
          <th scope="col">Omschrijving</th>
          <th scope="col">Resultaat</th>
        </tr>
      </thead>
      <tbody>
        <?php
        echo $show;
        ?>
      </tbody>

    </table>
    <button type='submit' class='btn btn-primary submit' style="align-items: right;">Opslaan</button>
  </form>
</div>