<?php
session_start();
include "../dbcon.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicine_name = $_POST['medicine_name'];
    $medicine_type = $_POST['medicine_type'];
    $quantity = $_POST['quantity'];
    $expiration_date = $_POST['expiration_date'];
    $supplier = $_POST['supplier'];

    $query = "INSERT INTO medicine_inventory (medicine_name, medicine_type, quantity, expiration_date, supplier) 
              VALUES ('$medicine_name', '$medicine_type', '$quantity', '$expiration_date', '$supplier')";

    if (mysqli_query($conn, $query)) {
        header("Location: medicine_inventory.php?success=Medicine added successfully");
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Medicine</title>
    <?php include "partials/head.php"; ?>
</head>
<body>
    <?php include "partials/sidebar.php"; ?>
    <?php include "partials/header.php"; ?>

    <div class="container">
        <h1>Add Medicine</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <label>Medicine Name:</label>
            <input type="text" name="medicine_name" required>

            <label for="medicine_type">Medicine Type:</label>
<select name="medicine_type" id="medicine_type">
    <option value="" disabled selected>Select Medicine Type</option>
    <option value="tablet">Tablet</option>
    <option value="capsule">Capsule</option>
    <option value="syrup">Syrup</option>
    <option value="injection">Injection</option>
    <option value="ointment">Ointment</option>
    <option value="cream">Cream</option>
    <option value="powder">Powder</option>
    <option value="spray">Spray</option>
</select>

            <label>Quantity:</label>
            <input type="number" name="quantity" required>

            <label>Expiration Date:</label>
            <input type="date" name="expiration_date">

            <label>Supplier:</label>
            <input type="text" name="supplier">

            <button type="submit">Add Medicine</button>
        </form>
    </div>
</body>
</html>
