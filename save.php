<?php
include 'db.php';

if (isset($_GET['action']) && $_GET['action'] == 'fetch') {
    $sql = "SELECT * FROM user_feedback ORDER BY id DESC";
    $res = mysqli_query($con, $sql);

    $html = '';
    while ($row = mysqli_fetch_assoc($res)) {
        $html .= '
            <tr>
                <td>' . $row['id'] . '</td>
                <td>' . htmlspecialchars($row['name']) . '</td>
                <td>' . htmlspecialchars($row['email']) . '</td>
                <td>' . $row['date_of_birth'] . '</td>
                <td>' . htmlspecialchars($row['contact']) . '</td>
                <td>' . htmlspecialchars($row['satisfaction_level']) . '</td>
                <td>' . htmlspecialchars($row['feedback']) . '</td>
                <td>
                    <a href="index.php?id=' . $row['id'] . '">Edit</a> |
                    <a href="#" onclick="deleteRecord(' . $row['id'] . ')">Delete</a>
                </td>
            </tr>';
    }

    echo json_encode(['my_data' => $html]);
    exit;
}

if ($_POST['action'] === 'save') {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $satisfaction = mysqli_real_escape_string($con, $_POST['satisfaction']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    if ($id > 0) {
        $sql = "UPDATE user_feedback SET 
                    `name` = '$name',
                    email = '$email',
                    date_of_birth = '$date',
                    contact = '$phone',
                    satisfaction_level = '$satisfaction',
                    feedback = '$message'
                WHERE id = $id";
    } else {
        $sql = "INSERT INTO user_feedback 
                    (`name`, email, date_of_birth, contact, satisfaction_level, feedback)
                VALUES 
                    ('$name', '$email', '$date', '$phone', '$satisfaction', '$message')";
    }

    $chk = mysqli_query($con, $sql);

    if ($chk) {
        if ($id > 0) {
            echo json_encode([
                'status' => 'success',
                'msg' => 'Feedback updated successfully.',
                'id' => $id
            ]);
        } else {
            $new_id = mysqli_insert_id($con);
            echo json_encode([
                'status' => 'success',
                'msg' => 'Feedback inserted successfully.',
                'id' => $new_id
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'msg' => 'Database query failed.'
        ]);
    }

    exit();
}

if ($_POST['action'] === 'delete') {
    $id = mysqli_real_escape_string($con, $_POST['id']);

    $sql = "DELETE FROM user_feedback WHERE id = $id";
    $chk = mysqli_query($con, $sql);

    if ($chk) {
        echo json_encode([
            'status' => 'success',
            'msg' => 'Feedback deleted successfully.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'msg' => 'Deletion failed.'
        ]);
    }

    exit();
}

?>
