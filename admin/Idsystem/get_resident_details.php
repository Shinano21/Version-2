<?php
include('config.php');

// Check if ID is passed
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the full details of the resident
    $sql = "SELECT fname, mname, lname, id_card_no, sex, zone, street, brgy, mun, contact FROM residents WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $resident = mysqli_fetch_assoc($result);

        // Prepare the data to send back as JSON
        $response = [
            'full_name' => $resident['fname'] . ' ' . $resident['mname'] . ' ' . $resident['lname'],
            'id_card_no' => $resident['id_card_no'],
            'sex' => $resident['sex'],
            'zone' => $resident['zone'],
            'street' => $resident['street'],
            'brgy' => $resident['brgy'],
            'mun' => $resident['mun'],
            'contact' => $resident['contact']
        ];

        // Send the data back as JSON
        echo json_encode($response);
    } else {
        echo json_encode(['error' => 'Resident not found']);
    }
} else {
    echo json_encode(['error' => 'No ID provided']);
}
?>
