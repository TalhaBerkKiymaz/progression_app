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
//     </a>'" . $lessons  . "'
// </td>

include("./connect_db.php");

$sql = "SELECT c.course_name as course_name, ass_p.ass_id ass_id, ass_p.student_id ass_student, ass.description as ass_description, s.firstname first_name, s.lastname as last_name,  ass_p.result ass_result, s.class_name s_classname, ass.lessons ass_lessons, p.pointurl point_url, p.description p_desc 
FROM assigment_points as ass_p
inner join assigments as ass on ass_p.ass_id = ass.id 
inner join students as s on s.id = ass_p.student_id 
inner join points as p on p.id = ass_p.result 
inner join course as c on c.lessons = ass.lessons 
WHERE ass.lessons = '" . $lessons  . "' and s.class_name = '" . $class_name  . "';";

// echo$sql;exit();
$result = mysqli_query($conn, $sql);
// var_dump($result);
$show = "<div class='row'>";
while ($record = mysqli_fetch_assoc($result)) {
  $assigmentid = $record['ass_id'];
  $assigment_student = $record['ass_student'];
  $assigment_result = $record['ass_result'];
  $student_classname = $record['s_classname'];
  $student_firstname =  $record['first_name'];
  $student_lastname = $record['last_name'];
  $assigment_lessons = $record['ass_lessons'];
  $assigment_desc = $record['ass_description'];
  $point_url = $record['point_url'];
  $pdescription = $record['p_desc'];
  $course = $record["course_name"];
  $show .= "
  <tr>
    <th scope='row'> {$assigment_student} </th>
    <td> {$student_firstname} </td>
    <td> {$student_lastname} </td>
    <td> {$assigmentid} </td>
    <td> {$assigment_desc} </td>
    <td> {$pdescription} </td>
    <td> 
          <img src='./img/results/{$point_url}' title='$pdescription'>
         </td>
    </tr>
    ";


  // var_dump($record);

}

mysqli_data_seek($result, 0);
$record = mysqli_fetch_assoc($result);
// echo "============================";
// var_dump($record);
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
          <th scope="col">Achternaam</th>
          <th scope="col">Hoofdstuk</th>
          <th scope="col">Uitleg</th>
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
  </form>
</div>