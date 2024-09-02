<?php
        include "dbcon.php";

        // Check if the program ID is set in the URL
        if (isset($_GET['id'])) {
            $programId = $_GET['id'];

            // Fetch program data based on the program ID
            $sql = "SELECT * FROM programs WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $programId);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            // Fetch the program details
            $program = mysqli_fetch_assoc($result);

            // Close the database connection
            mysqli_close($conn);
        } else {
            // Handle the case when program ID is not provided
            echo "Program ID not provided.";
            exit();
        }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $program['prog_heading']; ?> - CareVisio</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="shortcut icon" href="../src/favicon.png" type="image/x-icon">
    
    <style>
    .bodyCont {
        width: 100%;
        display: flex;
        justify-content: center;
        background-color: rgba(217, 217, 217, 0.3);
    }

    .detailsCont {
        width: 60%;
        min-height: calc(100vh - 80px);
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        background-color: white;
    }

    .back {
        margin: 20px;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .back p {
        padding-left: 7px;
        color: #6BB2F3;
        font-weight: 600;
    }

    .details {
        margin: 0 20px 20px;
        padding: 23px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.3);
    }

    .details img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php include 'navbar.php' ?>
    <?php
    include "dbcon.php";

    // Check if the program ID is set in the URL
    if (isset($_GET['id'])) {
        $programId = $_GET['id'];

        // Fetch program data based on the program ID
        $sql = "SELECT * FROM programs WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $programId);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        // Fetch the program details
        $program = mysqli_fetch_assoc($result);

        // Close the database connection
        mysqli_close($conn);
    } else {
        // Handle the case when program ID is not provided
        echo "Program ID not provided.";
        exit();
    }
    ?>
    <!-- Content -->
    <!-- Content -->
    <div class="bodyCont">
        <div class="detailsCont">
            <div class="back" id="goBackIcon"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                <p>Back</p>
            </div>
            <div class="details">
                <p style="font-size: small; margin: 0;"><?php echo $centerName ?></p>
                <p style="font-size: x-small; color: #888D8F; margin-top: 0;">
                    <?php 
                        // Convert military time to 12-hour format
                        $post_datetime_12hr = date("Y-m-d h:i A", strtotime($program['post_date']));
                        echo $post_datetime_12hr; 
                    ?>
                </p>
                <div class="prDetails">
                    <h2><?php echo $program['prog_heading']; ?></h2>
                    <p><?php echo $program['prog_body']; ?></p>
                </div>
                <?php
                    if ($program['prog_pic'] !== null) {
                      $imageType = strpos($program['prog_pic'], '/png') !== false ? 'png' : 'jpeg';
                      echo "<img src='data:image/{$imageType};base64," . base64_encode($program['prog_pic']). "' />";
                    } else {
                      echo "No image available";
                    }
                ?>
                <p style="font-size: x-small; color: #888D8F;"><?php echo $program['program_type']; ?></p>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php include 'footer.php' ?>

    <!-- ===============================scripts================================== -->
    <script>
    document.getElementById('goBackIcon').onclick = function() {
        goBack();
    };

    function goBack() {
        window.history.back();
    }
    </script>
</body>

</html>