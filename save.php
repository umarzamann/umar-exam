<?php
include 'db.php';
$id=mysqli_real_escape_string($con,$_POST['id']);
$name=mysqli_real_escape_string($con,$_POST['name']);
$email=mysqli_real_escape_string($con,$_POST['email']);
$date=mysqli_real_escape_string($con,$_POST['date']);
$phone=mysqli_real_escape_string($con,$_POST['phone']);
$satisfaction=mysqli_real_escape_string($con,$_POST['satisfaction']);
$message=mysqli_real_escape_string($con,$_POST['message']);

if($id > 0 ){
     $sql = "UPDATE user_feedback SET `name` = '$name',
    `email` = '$email',`date_of_birth` = '$date',`contact` = '$phone',`satisfaction_level` = '$satisfaction',`feedback` = '$message'
    where id = $id";
}else{
    $sql = "INSERT INTO user_feedback (`name`,email,date_of_birth,contact,satisfaction_level,feedback) Values
    ('$name','$email','$date','$phone','$satisfaction','$message')";
}
 $chk = mysqli_query($con,$sql);
if($chk){
    if($id>0){
        $new_id=$id;
        $msg = 'Updated successfully';
    }else{
        $new_id=mysqli_insert_id($con);
        $msg = 'Inserted successfully';
    }
}else{
    $msg = 'Failed';
}
header('location:index.php?id=' . $new_id . '&msg=' . $msg);
exit();
?>