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
  <div class="form-group form-group-tvg login-picture">
    <h1>Edit Je Opdracht</h1>
    <label for="Hoofdstuk">Hoofdstuk</label>
    <input type="text" class="form-control" id="id" placeholder="1.1, 2.1 & 3.4 enz." aria-describedby="idHelp" name="id" value="<?php echo $record['id']; ?>">
    
    <label for="lessons">Vakken</label>
    <div class="box">
      <select id="lessons" name="lessons" value="<?php echo $record['lessons']; ?>">
      <option value="<?php echo $record['lessons']; ?>" disabled selected><?php echo $record['lessons']; ?> (Selected)</option>
        <option value="WEB">WEB</option>
        <option value="NED">NED</option>
        <option value="ENG">ENG</option>
        <option value="BUR">BUR</option>
        <option value="ASP">ASP</option>
      </select>
    </div>
    
    <label for="description">Description</label>
    <input type="text" class="form-control" placeholder="Inhoud van de Opdracht " id="description" aria-describedby="descriptionHelp" name="description" value="<?php echo $record['description']; ?>">
    

    <label for="lastname">Deadline Datum</label>
    <input type="date" class="form-control" id="deadline" aria-describedby="deadlineHelp" name="deadline" value="<?php echo $record['ddline_date']; ?>">
   
    <button type="submit" class="btn btn-dark btn-lg btn-block mt-4">Updaten</button>
  </div>
</form>