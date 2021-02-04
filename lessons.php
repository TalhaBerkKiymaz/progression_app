<?php
/**
 * Omschrijving: Deze pagina geeft alle klassen weer die gekoppeld zijn aan een cursus.
 * Afhankelijk van: class_course/lessons    
 */
include("./connect_db.php");


$sql = "SELECT  c.class_name, cc.lessons, c.education from class_course as cc, class as c GROUP BY cc.lessons";

// SELECT  c.class_name, cc.lessons, c.education from class_course as cc, class as c GROUP BY cc.lessons
// SELECT  c.class_name, cc.lessons, c.education from class_course as cc, class as c where c.class_name = 'am2a' and c.class_name = cc.class_name"

$result = mysqli_query($conn, $sql);

$show = "<div class='row'>";
while ($record = mysqli_fetch_assoc($result)) {
    $show .= "<div class='col-3'>
                <div class= 'card mb-2' style='width: 18rem;'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$record['class_name']}</h5>
                        <h6 class='card-subtitle mb-2 text-muted'>{$record['education']}</h6>
                        <p class='card-text'>{$record['lessons']}</p>
                        <a href='student.php' class='card-link'>Card link</a>
                        <a href='#' class='card-link'>Another link</a>
                    </div>
                </div>
            </div>";

    var_dump($record);
}

echo $show;
?>