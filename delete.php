<?php
include 'db.php';
$id=mysqli_real_escape_string($con,$_GET['id']);
$sql = "delete from user_feedback where id = $id";
$chk = mysqli_query($con,$sql);
if($chk){
        $msg = 'Deleted successfully';
}else{
    $msg = 'Failed';
}
header('location:table.php?msg=' . $msg);
exit();
?>