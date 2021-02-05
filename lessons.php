<?php
/**
 * Omschrijving: Deze pagina geeft alle vakken weer die gekoppeld zijn aan een klas.
 * Afhankelijk van: class_course/lessons    
 */
$class_name = $_GET["class"];
include("./connect_db.php");


$sql = "SELECT  `course`.`description`,`course`.`course_name`, c.class_name, cc.lessons, c.education 
        from class_course as cc, class as c, course 
        where `course`.`lessons` = cc.`lessons`
        and cc.`class_name` = '" . $class_name  . "'
        GROUP BY cc.lessons DESC";
// echo $sql;exit();
// SELECT  c.class_name, cc.lessons, c.education from class_course as cc, class as c GROUP BY cc.lessons
// SELECT  c.class_name, cc.lessons, c.education from class_course as cc, class as c where c.class_name = 'am2a' and c.class_name = cc.class_name"

$result = mysqli_query($conn, $sql);


$show = "<div class='row'>";
while ($record = mysqli_fetch_assoc($result)) {
    $show .= "
            <div class='col-sm-6' style='padding-top: 20px;'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$record['lessons']}</h5>
                            <p class='card-text'>{$record['course_name']}.</p>
                            <p class='card-text'><b>{$record['description']}.</b></p>
                            <p class='text-muted'>Klik hieronder om voortgang van studenten te zien</p>
                            <a href='index.php?content=student&class=$class_name&lesson={$record['lessons']}' class='btn btn-warning'><b>Voortgang</b></a>
                         </div>
                    </div>
            </div>";

//     var_dump($record);
}

mysqli_data_seek($result,0);
$record = mysqli_fetch_assoc($result);
// echo "============================";
// var_dump($record);
$class = $record["class_name"];
echo "<h1 style='color: red;'>" . $class_name . "</h1>";
echo $show;
?>