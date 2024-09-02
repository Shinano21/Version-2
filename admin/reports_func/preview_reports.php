<?php 
include "../dbcon.php";

// Table structure
$table = [
    "Full Name" => [
        "fname" => "",
        "mname" => "",
        "lname" => "",
    ],
    "Sex" => "",
    "Age" => "",
    "Birthday" => "",
    "Address" => [
        "street" => "",
        "zone"=> "",
        "brgy"=> "",
        "mun"=> "",
        "province"=> "",
    ]
];
$ageGroup = [
    "0-11 Months" => "DATEDIFF(NOW(), bday) <= 365",
    "1-5" => "DATEDIFF(NOW(), bday) > 365 AND DATEDIFF(NOW(), bday) <= 2189",
    "6-12" => "DATEDIFF(NOW(), bday) > 2189 AND DATEDIFF(NOW(), bday) <= 4744",
    "13-19" => "DATEDIFF(NOW(), bday) > 4744 AND DATEDIFF(NOW(), bday) <= 7299",
    "20-29" => "DATEDIFF(NOW(), bday) > 7299 AND DATEDIFF(NOW(), bday) <= 10949",
    "30-39" => "DATEDIFF(NOW(), bday) > 10949 AND DATEDIFF(NOW(), bday) <= 14599",
    "40-49" => "DATEDIFF(NOW(), bday) > 14599 AND DATEDIFF(NOW(), bday) <= 18249",
    "50-59" => "DATEDIFF(NOW(), bday) > 18249 AND DATEDIFF(NOW(), bday) <= 21899",
    "60-69" => "DATEDIFF(NOW(), bday) > 21899 AND DATEDIFF(NOW(), bday) <= 25549",
    "70-79" => "DATEDIFF(NOW(), bday) > 25549 AND DATEDIFF(NOW(), bday) <= 29199",
    "80+" => "DATEDIFF(NOW(), bday) > 29199",
];

$sql = [];

function setJSONContentType() {
    header('Content-Type: application/json');
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['filter'])) {
        $filter = $_POST['filter'];
        if ($filter === '2') {
            $category1 = $_POST['category1'];
            $option1 = mysqli_real_escape_string($conn, $_POST["option1"]);
            $category2 = $_POST['category2'];
            $option2 = mysqli_real_escape_string($conn, $_POST["option2"]);
            // $category1, $option1, $category2, $option2 for database queries or processing
            if(!empty($category1) && !empty($option1 && !empty($category2) && !empty($option2))) {
                if ($category1 == 'bday'){
                    $query = "SELECT * FROM residents WHERE $ageGroup[$option1] AND $category2 = '$option2' AND `status` = 'active' ORDER BY lname";
                } else if ($category2 == 'bday'){
                    $query = "SELECT * FROM residents WHERE $category2 = '$option2' AND $ageGroup[$option2] AND `status` = 'active' ORDER BY lname";
                } else {
                    $query = "SELECT * FROM residents WHERE $category1 = '$option1' AND $category2 = '$option2' AND `status` = 'active' ORDER BY lname";
                }
                
                $result = mysqli_query($conn, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)){
                        $sql[] = $row;
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }

        } else {
            $category1 = $_POST['category1'];
            
            // $category1, $option1 for database queries or processing
            if(!empty($category1)) {
                $option1 = $_POST['option1'];
                if(!empty($option1)){
                    if ($category1 == 'bday'){
                        $query = "SELECT * FROM residents WHERE $ageGroup[$option1] AND `status` = 'active' ORDER BY lname";
                    } else {
                        $query = "SELECT * FROM residents WHERE $category1 = '$option1' AND `status` = 'active' ORDER BY lname";
                    }
                } else {
                    $query = "SELECT * FROM residents";
                }
                $result = mysqli_query($conn, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)){
                        $sql[] = $row;
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        }
    } else {
        $category1 = $_POST['category1'];
        
        // $category1, $option1 for database queries or processing
        if(!empty($category1)) {
            $option1 = $_POST['option1'];
            if(!empty($option1)){
                if ($category1 == 'bday'){
                    $query = "SELECT * FROM residents WHERE $ageGroup[$option1] AND `status` = 'active' ORDER BY lname";
                } else{
                    $query = "SELECT * FROM residents WHERE $category1 = '$option1' AND `status` = 'active' ORDER BY lname";
                }
            } else {
                $query = "SELECT * FROM residents  WHERE `status` = 'active' ORDER BY lname";
            }
            $result = mysqli_query($conn, $query);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)){
                    $sql[] = $row;
                }
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
        // Prepare the response to send back to JavaScript
        $response = [
        'message' => 'Data processed successfully', 
        'data' => $sql
];

setJSONContentType();
echo json_encode($response);
}
?>