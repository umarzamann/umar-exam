<?php
include 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$row = [];

if ($id > 0) {
    $sql = "SELECT * FROM user_feedback WHERE id = $id";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form – Umar Z.</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #444;
            color: #fff;
            padding: 12px 20px;
            border-radius: 5px;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            z-index: 1000;
        }

        .toast.show {
            opacity: 1;
        }

        .form-type {
            margin-bottom: 12px;
        }

        label {
            display: block;
            margin-bottom: 6px;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Feedback Form</h1>

        <div class="toast" id="toast"></div>

        <form id="form">
            <input type="hidden" name="id" value="<?= $id; ?>">

            <div class="form-type">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required value="<?= $row['name'] ?? ''; ?>">
            </div>

            <div class="form-type">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required value="<?= $row['email'] ?? ''; ?>">
            </div>

            <div class="form-type">
                <label for="date">Date of Birth:</label>
                <input type="date" id="date" name="date" required value="<?= $row['date_of_birth'] ?? ''; ?>">
            </div>

            <div class="form-type">
                <label for="phone">Contact:</label>
                <input type="tel" id="phone" name="phone" required value="<?= $row['contact'] ?? ''; ?>">
            </div>

            <div class="form-type">
                <label for="satisfaction">Satisfaction Level:</label>
                <input type="range" id="satisfaction" name="satisfaction" min="1" max="100"
                    value="<?= $row['satisfaction_level'] ?? '50'; ?>">
            </div>

            <div class="form-type">
                <label for="message">Your Feedback:</label>
                <textarea id="message" name="message" required><?= $row['feedback'] ?? ''; ?></textarea>
            </div>

            <button type="submit">Submit Feedback</button>
        </form>
    </div>

    <script>
        const form = document.getElementById('form');
        const toast = document.getElementById('toast');

        function showToast(msg) {
            toast.textContent = msg;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 5000);
        }

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            formData.append('action', 'save');

            fetch('save.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    showToast(data.msg);
                    if (!formData.get('id')) {
                        form.reset();
                    } else {
                        // setTimeout(() => {
                        //     window.location.href = 'table.php?msg=' + encodeURIComponent(data.msg);
                        // }, 1000);
                    }
                } else {
                    showToast(data.msg || "Error saving feedback.");
                }
            })
            .catch(err => {
                showToast("AJAX error occurred.");
                console.error(err);
            });
        });
    </script>
</body>

</html>
