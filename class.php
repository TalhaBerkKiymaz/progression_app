<?php
include("./functions.php");
is_authorized(["admin", "teacher", "director",]);
/**
 * Omschrijving: Deze pagina geeft alle klassen weer die gekoppeld zijn aan een cursus.
 * Afhankelijk van: class_course/class  
 */
include("./connect_db.php");

$sql = "SELECT  c.class_name, c.education, c.cohort from class as c GROUP BY c.class_name";

// SELECT  c.class_name, cc.lessons, c.education from class_course as cc, class as c GROUP BY cc.lessons
// SELECT  c.class_name, cc.lessons, c.education from class_course as cc, class as c where c.class_name = 'am2a' and c.class_name = cc.class_name"

$result = mysqli_query($conn, $sql);

$show = "<div class='row'>
            <div class='col-12' id='card-title'>
                <h2>Kies een Klas</h2>
                </div>
                ";
while ($record = mysqli_fetch_assoc($result)) {
    $show .= "
    <div class='col-3'>
    <div class='card-main'>
    
    <div class='card'>
        <div class='front'>
            <div class='front-content middle'>
                <h2>{$record['class_name']}</h3>
            </div>
        </div>
        <div class='back'>
            <div class='back-content middle'>
                <h2>{$record['education']}<br><hr style='border: 2px solid;'>
                <h3>Applicatie- en mediaontwikkelaar</h3>
                <hr style='border: 2px solid;'>
                </h2>
                <h5 style='text-align: end;'>Cohort:{$record['cohort']}</h5>
                <hr>
                <a href='index.php?content=lessons&class={$record['class_name']}' class='btn btn-warning'>Vakken
                </a>
            </div>
        </div>
    </div>
    </div>
    </div>

";

    // var_dump($record);
}

echo $show;
?>

