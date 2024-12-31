<?php
include "dbcon.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST['confirm'] === 'yes') {
            $password = $_POST['password'] ?? '';
            if ($password === 'imstrong09') {
                // Perform the deletion
                $sql = "DELETE FROM residents WHERE id = '$id'";
                if (mysqli_query($conn, $sql)) {
                    echo '<script>
                        alert("Record deleted successfully.");
                        window.opener.location.reload(); // Refresh the parent page
                        window.close(); // Close the pop-up
                    </script>';
                } else {
                    echo '<script>alert("Error deleting record: ' . mysqli_error($conn) . '");</script>';
                }
            } else {
                echo '<script>alert("Incorrect password. Please try again.");</script>';
            }
        } elseif ($_POST['confirm'] === 'no') {
            // Close the pop-up or redirect back
            echo '<script>window.close();</script>';
        }
    }
} else {
    echo "Invalid request.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirm Delete</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h3 {
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        input[type="password"], button {
            padding: 10px;
            margin: 5px;
            font-size: 14px;
        }
        button {
            background-color: #006BDD;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #005BBB;
        }
    </style>
</head>
<body>
    <h3>Are you sure you want to delete this resident?</h3>
    <form method="POST">
        <div id="password-section" style="display: none;">
            <label for="password">Enter password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <br>
        <button type="button" id="yes-button">Yes</button>
        <button type="submit" name="confirm" value="no">No</button>
        <button type="submit" name="confirm" value="yes" style="display: none;" id="confirm-yes-button"></button>
    </form>

    <script>
        const yesButton = document.getElementById('yes-button');
        const confirmYesButton = document.getElementById('confirm-yes-button');
        const passwordSection = document.getElementById('password-section');

        yesButton.addEventListener('click', () => {
            // Show the password field and change the "Yes" button to submit the form
            passwordSection.style.display = 'block';
            confirmYesButton.click();
        });
    </script>
</body>
</html>
