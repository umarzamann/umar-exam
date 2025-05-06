<?php
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Table – Umar Z.</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px 12px;
            border: 1px solid #333;
            text-align: left;
        }

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
    </style>
</head>

<body>
<a href="index.php" style="display: inline-block; margin-bottom: 15px; background-color: #007bff; color: white; padding: 10px 16px; text-decoration: none; border-radius: 4px;">
        + Create Record
    </a>

    <h1>User Feedback List</h1>

    <div class="toast" id="toast"><?= htmlspecialchars($msg) ?></div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Phone</th>
                <th>Satisfaction</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="feedback-table-body">
            <!-- Data will be loaded here -->
        </tbody>
    </table>

    <script>
        function loadTable() {
            fetch('save.php?action=fetch')
                .then(res => res.json())
                .then(data => {
                    document.getElementById('feedback-table-body').innerHTML = data.my_data;
                });
        }

        function showToast(msg) {
            const toast = document.getElementById('toast');
            if (msg.trim() !== '') {
                toast.textContent = msg;
                toast.classList.add('show');
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 5000);
            }
        }

        function deleteRecord(id) {
            if (confirm("Are you sure you want to delete this feedback?")) {
                fetch('save.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `action=delete&id=${id}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        loadTable();
                        showToast(data.msg);
                    } else {
                        showToast(data.msg || "Deletion failed");
                    }
                });
            }
        }

       
        loadTable();

       
        showToast("<?= htmlspecialchars($msg) ?>");
    </script>
</body>

</html>
