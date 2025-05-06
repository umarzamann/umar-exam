<?php
include 'db.php';

$sql = "select * from user_feedback";
$res = mysqli_query( $con, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Umar Z.</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            border: 1px solid black;
        }
    </style>
</head>

<body>
<?php
            if (isset($_GET['msg'])) {
                echo $_GET['msg'];
            }
            ?>
        <table>
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>date</th>
                <th>phone</th>
                <th>satisfaction</th>
                <th>message</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($res)) { ?>
                  <tr>
                  <td><?= $row['id']; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['date_of_birth']; ?></td>
                    <td><?= $row['contact']; ?></td>
                    <td><?= $row['satisfaction_level']; ?></td>
                    <td><?= $row['feedback'] ?></td>
                    <td>
                        <a href="index.php?id=<?= $row['id']; ?>">Edit</a>
                        |
                        <a href="delete.php?id=<?= $row['id']; ?>">Delete</a>
                    </td>
                  </tr>
                <?php }
                ?>
            </tbody>
        </table>
        
   

</body>


</html>