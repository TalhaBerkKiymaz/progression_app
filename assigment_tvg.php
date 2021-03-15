<?php
    include("./connect_db.php");

    $sql = "SELECT * FROM `assigments`";

    $result = mysqli_query($conn, $sql);

    $tbl_rows = "";
    while ($record = mysqli_fetch_assoc($result)) {
        $tbl_rows .= "<tr>
                        <th scope='row'>{$record['id']}</th>
                        <td>{$record['lessons']}</td>
                        <td>{$record['description']}</td>
                        <td>{$record['ddline_date']}</td>
                        <td><i class='bi bi-pencil-square' style='color:blue;'></i></td>
                        <td><i class='bi bi-x-square text-danger'></i></td>
                    </tr>";
    }
?>

<div class="row my-3">
    <div class="col-12">
        <button type="submit" class="btn btn-success btn-lg btn-block mt-4" >Voeg een nieuwe cursus toe</button>
    </div>
</div>
<div class="row">
    <div class="col-12" >
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Lesson</th>
                    <th scope="col">Description</th>
                    <th scope="col">Deadline</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $tbl_rows; ?>
            </tbody>
        </table>
    </div>
</div>