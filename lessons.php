<?php
include("./functions.php");
is_authorized(["admin", "teacher", "director",]);
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
    <div class='col-3'>
    <div class='card-main'>
    
    <div class='card'>
        <div class='front'>
            <div class='front-content middle'>
                <h2>{$record['lessons']}</h3>
            </div>
        </div>
        <div class='back'>
            <div class='back-content middle'>
                <h2>{$record['course_name']}<br><hr style='border: 2px solid;'>
                <h3>Applicatie- en mediaontwikkelaar</h3>
                <hr style='border: 2px solid;'>
                </h2>
                <h5'>{$record['description']}</h5>
                <hr>
                <a href='index.php?content=student&class=$class_name&lesson={$record['lessons']}' class='btn btn-warning'>Overzicht
                </a>
            </div>
        </div>
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
echo "<h1 id='card-title'>" . $class_name . "</h1>";
echo $show;
?>