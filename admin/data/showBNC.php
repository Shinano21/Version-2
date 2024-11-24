<?php
include "../dbcon.php";

$sql = "SELECT * FROM organization";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $name = $row['name'];
        $position = $row['position'];
        $contact_info = $row['contact_info'];
        $description = $row['description'];
        $photo = $row['photo'] ? 'data:image/jpeg;base64,' . base64_encode($row['photo']) : 'placeholder.jpg'; // Replace with your placeholder path if photo is null

        echo "<tr>";
        echo "<td>{$name}</td>";
        echo "<td>{$position}</td>";
        echo "<td><img src='{$photo}' alt='{$name}' style='width:50px; height:50px;'></td>";
        echo "<td>";
        echo "<a href='editBNC.php?id={$id}' class='edit-btn'>Edit</a> | ";
        echo "<a href='deleteBNC.php?id={$id}' class='delete-btn' onclick='return confirm(\"Are you sure?\");'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No members found.</td></tr>";
}
?>
