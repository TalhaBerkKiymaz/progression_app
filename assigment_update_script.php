<?php
// Maak contact met de mysqlserver en database
    include ("./connect_db.php");

    include("./functions.php");

    $id = $_POST["id"];
    $lessons = sanitize($_POST["lessons"]);
    $description = sanitize($_POST["description"]);
    $date = sanitize($_POST["deadline"]);

    $sql = "UPDATE `assigments` 
                SET `id` = '$id', 
                    `lessons` = '$lessons', 
                    `description` = '$description',
                    `ddline_date` = '$date' 
            WHERE `id` = $id;";

    mysqli_query($conn, $sql);

    header("Location: ./index.php?content=assigment")
?>