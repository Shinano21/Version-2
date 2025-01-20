<?php
include "../dbcon.php";

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$medicine_name = $data['medicine_name'] ?? '';

if ($medicine_name) {
    $stmt = $conn->prepare("SELECT quantity FROM medicine_inventory WHERE medicine_name = ?");
    $stmt->bind_param("s", $medicine_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        echo json_encode(['success' => true, 'available_quantity' => $row['quantity']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Medicine not found or unavailable.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
