<?php
$id = $_GET["id"];

include("./connect_db.php");

$sql = "SELECT * FROM `assigments` WHERE `id` = $id";

$result = mysqli_query($conn, $sql);

$record = mysqli_fetch_assoc($result);

echo "<pre>";
// var_dump($record);
echo "</pre>";
?>


<form action="./index.php?content=assigment_update_script" method="post">
<div class="form-group">
    <label for="lessons">id</label>
    <input type="text" class="form-control" id="id" aria-describedby="idHelp" name="id" value="<?php echo $record['id']; ?>">
    <small id="idHelp" class="form-text text-muted">Vul hier les in</small>

    <label for="lessons">Lessons</label>
    <input type="text" class="form-control" id="lessons" aria-describedby="lessonsHelp" name="lessons" value="<?php echo $record['lessons']; ?>">
    <small id="lessonsHelp" class="form-text text-muted">Vul hier les in</small>
 
 
    <label for="description">Description</label>
    <input type="text" class="form-control" id="description" aria-describedby="descriptionHelp" name="description" value="<?php echo $record['description']; ?>">
    <small id="descriptionHelp" class="form-text text-muted">Vul hier description in</small>

    <label for="lastname">Deadline</label>
    <input type="date" class="form-control" id="deadline" aria-describedby="deadlineHelp" name="deadline" value="<?php echo $record['ddline_date']; ?>">
    <small id="deadlineHelp" class="form-text text-muted">Vul hier uw achternaam in.</small>
  
  <button type="submit" class="btn btn-primary">Versturen</button>
</div>
</form>