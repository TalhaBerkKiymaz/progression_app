<?php

/**
 * Omschrijving: Deze pagina geeft alle klassen weer die gekoppeld zijn aan een cursus.
 * Afhankelijk van: class_course/lessons    
 */
include("./connect_db.php");

$sql = "SELECT  c.class_name, c.education, c.cohort from class as c GROUP BY c.class_name";

// SELECT  c.class_name, cc.lessons, c.education from class_course as cc, class as c GROUP BY cc.lessons
// SELECT  c.class_name, cc.lessons, c.education from class_course as cc, class as c where c.class_name = 'am2a' and c.class_name = cc.class_name"

$result = mysqli_query($conn, $sql);

$show = "<div class='row'>";
while ($record = mysqli_fetch_assoc($result)) {
    $show .= "
    <div class= 'col-3'>
            <div class='card text-center' style='width: 16rem;'>
                <h5 class='card-header'>{$record['class_name']} <h7>({$record['cohort']})</h7></h5>
                <div class='card-body'>
                    
                    <p class='card-text'>Hier vind je de Lesvakken van klas {$record['class_name']}.</p>
                    <a href='index.php?content=lessons&class={$record['class_name']}' class='btn btn-primary'>Vakken</a>
                </div>
            </div>
    </div>";

    // var_dump($record);
}

echo $show;
