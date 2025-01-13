<?php
session_start();
include "../dbcon.php";

// Fetch medicine details
if (isset($_GET['id'])) {
    $medicine_id = $_GET['id'];
    $query = "SELECT * FROM medicine_inventory WHERE medicine_id = $medicine_id";
    $result = mysqli_query($conn, $query);
    $medicine = mysqli_fetch_assoc($result);
}

// Update medicine details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicine_id = $_POST['medicine_id'];
    $medicine_name = $_POST['medicine_name'];
    $medicine_type = $_POST['medicine_type'];
    $quantity = $_POST['quantity'];
    $expiration_date = $_POST['expiration_date'];
    $supplier = $_POST['supplier'];

    $query = "UPDATE medicine_inventory SET 
              medicine_name = '$medicine_name',
              medicine_type = '$medicine_type',
              quantity = '$quantity',
              expiration_date = '$expiration_date',
              supplier = '$supplier'
              WHERE medicine_id = $medicine_id";

    if (mysqli_query($conn, $query)) {
        header("Location: medicine_inventory.php?success=Medicine updated successfully");
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
    <title>Edit Medicine</title>
    <?php include "partials/head.php"; ?>
</head>
<body>
    <?php include "partials/sidebar.php"; ?>
    <?php include "partials/header.php"; ?>

    <div class="container">
        <h1>Edit Medicine</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="hidden" name="medicine_id" value="<?= $medicine['medicine_id'] ?>">

            <label>Medicine Name:</label>
            <input type="text" name="medicine_name" value="<?= $medicine['medicine_name'] ?>" required>

            <label>Medicine Type:</label>
            <input type="text" name="medicine_type" value="<?= $medicine['medicine_type'] ?>">

            <label>Quantity:</label>
            <input type="number" name="quantity" value="<?= $medicine['quantity'] ?>" required>

            <label>Expiration Date:</label>
            <input type="date" name="expiration_date" value="<?= $medicine['expiration_date'] ?>">

            <label>Supplier:</label>
            <input type="text" name="supplier" value="<?= $medicine['supplier'] ?>">

            <button type="submit">Update Medicine</button>
        </form>
    </div>
</body>
</html>
