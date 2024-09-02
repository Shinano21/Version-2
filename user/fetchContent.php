<?php
include "dbcon.php";

// Function to fetch program data based on program type
function fetchProgramsByType($conn, $programType) {
    if ($programType == "All Programs") {
        $sql = "SELECT * FROM programs";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $programs[] = $row;
        }
    } else {
        $sql = "SELECT * FROM programs WHERE program_type = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $programType);
        mysqli_stmt_execute($stmt);
    
        $result = mysqli_stmt_get_result($stmt);
    
        $programs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $programs[] = $row;
        }
    }
    return $programs;
}

// Fetch programs for each tab
$allPrograms = fetchProgramsByType($conn, 'All Programs');
$basicHealthcarePrograms = fetchProgramsByType($conn, 'Basic Healthcare');
$prePostNatalCarePrograms = fetchProgramsByType($conn, 'Pre & Post Natal Care');
$familyPlanningPrograms = fetchProgramsByType($conn, 'Family Planning');
$immunizationPrograms = fetchProgramsByType($conn, 'Immunization');
$vaccinationsPrograms = fetchProgramsByType($conn, 'Vaccination');
$nutritionPrograms = fetchProgramsByType($conn, 'Nutrition Program');
$othersPrograms = fetchProgramsByType($conn, 'Others');

// Close the database connection
mysqli_close($conn);
?>