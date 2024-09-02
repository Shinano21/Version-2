<?php
//For Testing 
include "dbcon.php";

if(isset($_POST["submit"])){
    $user = $_POST["user"];
    $pass = ($_POST["password"]);
    
    $predefinedAccounts = [
        'System_Admin' => 'SystemAdmin',
        'Brgy_Nurse' => 'BrgyNurse',
        'Brgy_HealthWorker' => 'BrgyHealthWorker'
    ];

    // $predefinedAccounts = [
    //     'System_Admin' => '$2y$10$X/ZW5JcsHsN.kxDhLpPHVeR1ZCpZL6TP04iaxtdFHrvnl.luvv1zi',
    //     'Brgy_Secretary' => '$2y$10$X/ZW5JcsHsN.kxDhLpPHVeR1ZCpZL6TP04iaxtdFHrvnl.luvv1zi',
    //     'Brgy_HealthWorker' => '$2y$10$X/ZW5JcsHsN.kxDhLpPHVeR1ZCpZL6TP04iaxtdFHrvnl.luvv1zi'
    // ];

    if (array_key_exists($user, $predefinedAccounts) && $pass === $predefinedAccounts[$user]) {
        
        $_SESSION["user"] = $user;
        $_SESSION["user_type"] = getUserType($user); 
        header("Location: index.php");
        exit();
    }

    $sql = "SELECT * FROM `administrator` WHERE `user` ='$user' AND `a_status`='Active'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userType = $row['user_type'];

        switch ($userType) {
            case 'System Administrator':
            case 'Barangay Nurse':
            case 'Barangay Health Worker':

                if (password_verify($pass, $row["password"])) {
                    $_SESSION["user"] = $user;
                    $_SESSION["user_type"] = $userType;
                    header("Location: index.php");
                    exit();
                } else {
                    
                    header("Location: index.php?error=INCORRECT PASSWORD");
                    exit();
                }
                break;
            default:
                header("Location: index.php?error=Invalid user type!&user=$user");
                exit();
        }
    } else {
        header("Location: index.php?error=Incorrect email or password!&user=$user");
    }
}

function getUserType($username) {
    $userTypeMap = [
        'System_Admin' => 'System Administrator',
        'Brgy_Nurse' => 'Barangay Nurse',
        'Brgy_HealthWorker' => 'Barangay Health Worker'
    ];

    return $userTypeMap[$username] ?? '';
}
?>
