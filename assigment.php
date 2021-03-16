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
                        <td>
                            <a href='./index.php?content=assigment_update&id=" . $record["id"] . "'>
                                <img src='./img/icons/b_edit.png' alt=; pencil'>
                        </a>
                        </td>
                        <td>
                            <a href='./index.php?content=assigment_delete&id=" . $record["id"] . "'>
                                <img src='./img/icons/b_drop.png' alt=; cross'>
                            </a>
                        </td>
                    </tr>";
    }
?>

<div class="row my-3">
    <div class="col-12">
        <a type="submit" href="./index.php?content=assigment_tvg" class="btn btn-dark btn-lg btn-block mt-4" >Voeg een nieuwe cursus toe</a>
    </div>
</div>
<div class="row">
    <div class="col-12" >
        <table class="table table-hover" id="table-assigment">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">lessons</th>
                    <th scope="col">description</th>
                    <th scope="col">ddline_date</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $tbl_rows; ?>
            </tbody>
        </table>
    </div>
</div>