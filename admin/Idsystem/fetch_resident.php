<?php
header('Content-Type: application/json');
include 'config.php'; // Include your database connection

// Get the JSON input
$input = json_decode(file_get_contents('php://input'), true);
$id_card_no = $input['id_card_no'] ?? '';

if (!empty($id_card_no)) {
    // Prepare the SQL query to fetch resident data using id_card_no
    $stmt = $conn->prepare("SELECT * FROM residents WHERE id_card_no = ?");
    $stmt->bind_param("s", $id_card_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $resident = $result->fetch_assoc();

        // Calculate age based on birthday
        $age = date_diff(date_create($resident['bday']), date_create('today'))->y;
// Assuming 'profile' stores the image filename
$profileImagePath = 'residents_img/' . $resident['profile']; // Path relative to the web root
        // Return resident data as JSON
        echo json_encode([
            'success' => true,
            'fname' => $resident['fname'],
            'mname' => $resident['mname'],
            'lname' => $resident['lname'],
            'sex' => $resident['sex'],
            'bday' => $resident['bday'],
            'age' => $age,
            'pob' => $resident['pob'],
            'religion' => $resident['religion'],
            'citizenship' => $resident['citizenship'],
            'street' => $resident['street'],
            'zone' => $resident['zone'],
            'brgy' => $resident['brgy'],
            'mun' => $resident['mun'],
            'province' => $resident['province'],
            'zipcode' => $resident['zipcode'],
            'contact' => $resident['contact'],
            'educational' => $resident['educational'],
            'occupation' => $resident['occupation'],
            'civil_status' => $resident['civil_status'],
            'labor_status' => $resident['labor_status'],
            'voter_status' => $resident['voter_status'],
            'pwd_status' => $resident['pwd_status'],
            'four_p' => $resident['four_p'],
            'vac_status' => $resident['vac_status'],
            'status' => $resident['status'],
            'longitude' => $resident['longitude'],
            'latitude' => $resident['latitude'],
            'profile' => $profileImagePath, // Send the relative path to the image
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Resident not found.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID Card Number is empty.']);
}
?>
