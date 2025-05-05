<?php
include 'db.php';
if ($_GET['id']) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
} else {
    $id = 0;
}

$sql = "select * from user_feedback where id=$id";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Umar Z.</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="container">
        <h1>Feedback Form</h1>
        <div>
            <?php
            if (isset($_GET['msg'])) {
                echo $_GET['msg'];
            }
            ?>
        </div>
        <form id="form" action="save.php" method="post">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <div class="form-type">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo (!empty($row) ? $row['name'] : 'N/A'); ?>">
            </div>

            <div class="form-type">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo (!empty($row) ? $row['email'] : 'N/A'); ?>">
            </div>

            <div class="form-type">
                <label for="date">Date of Birth</label>
                <input type="date" id="date" name="date" value="<?php echo (!empty($row) ? $row['date_of_birth'] : 'N/A'); ?>">
            </div>

            <div class="form-type">
                <label for="phone">Contact</label>
                <input type="tel" id="phone" name="phone" value="<?php echo (!empty($row) ? $row['contact'] : 'N/A'); ?>">
            </div>

            <div class="form-type">
                <label>Satisfaction Level:</label>
                <input type="range" id="satisfaction" name="satisfaction"
                    min="1" max="100" value="<?php echo (!empty($row) ? $row['satisfaction_level'] : '0'); ?>">
            </div>

            <div class="form-type">
                <label for="message">Your Feedback:</label>
                <textarea id="message" name="message"><?php echo (!empty($row) ? $row['feedback'] : 'N/A'); ?></textarea>
            </div>

            <button type="submit">Submit Feedback</button>
        </form>
        <!-- submitted data -->
        <div id="submitted-data"></div>
    </div>

</body>

<!-- <script>
    const form = document.getElementById('form');
    const submittedData = document.getElementById('submitted-data');

function storeFormData() {
    const user = {
        name: form.name.value,
        email: form.email.value,
        date: form.date.value,
        phone: form.phone.value,
        satisfaction: form.satisfaction.value,
        message: form.message.value
    };
    
   // console.log(user);

    // Displaying the submitted data
    submittedData.innerHTML = `
            <h2>Submitted Feedback:</h2>
            <p><strong>Name:</strong> ${user.name}</p>
            <p><strong>Email:</strong> ${user.email}</p>
            <p><strong>Email:</strong> ${user.date}</p>
            <p><strong>Phone:</strong> ${user.phone}</p>
            <p><strong>Satisfaction Level:</strong> ${user.satisfaction}</p>
            <p><strong>Message:</strong> ${user.message}</p>`;
}  

function processFormData(event) {
    event.preventDefault();

    // form validity
    if (!form.checkValidity()) {
        return;
    }

    // If valid, store the form data
    storeFormData();
}

</script> -->


</html>