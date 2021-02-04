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
        GROUP BY cc.lessons";
// echo $sql;exit();
// SELECT  c.class_name, cc.lessons, c.education from class_course as cc, class as c GROUP BY cc.lessons
// SELECT  c.class_name, cc.lessons, c.education from class_course as cc, class as c where c.class_name = 'am2a' and c.class_name = cc.class_name"

$result = mysqli_query($conn, $sql);


$show = "<div class='row'>";
while ($record = mysqli_fetch_assoc($result)) {
    $show .= "<div class='col-3'>
                <div class= 'card mb-2' style='width: 18rem;'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$record['lessons']}</h5>
                        <h6 class='card-subtitle mb-2 text-muted'>{$record['description']}</h6>
                        <p class='card-text'>{$record['course_name']}</p>
                        <a href='student.php' class='card-link'>Card link</a>
                        <a href='#' class='card-link'>Another link</a>
                    </div>
                </div>
            </div>";

    // var_dump($record);
}

mysqli_data_seek($result,0);
$record = mysqli_fetch_assoc($result);
// echo "============================";
// var_dump($record);
$class = $record["class_name"];
echo "<h1>" . $class_name . "</h1>";
echo $show;
?>