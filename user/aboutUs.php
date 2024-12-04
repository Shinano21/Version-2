<?php
// Include database connection
include "dbcon.php";

// Fetch organization data for the hierarchy
function buildHierarchy($parent_id = null, $conn) {
    $sql = "SELECT * FROM organization WHERE parent_id " . ($parent_id === null ? "IS NULL" : "= ?");
    $stmt = $conn->prepare($sql);

    if ($parent_id !== null) {
        $stmt->bind_param("i", $parent_id);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            $name = htmlspecialchars($row['name']);
            $position = htmlspecialchars($row['position']);
            $photo = $row['photo'] ? "admin/images/bnc/" . $row['photo'] : "admin/images/default_avatar.png";

            echo "<li>";
            echo "<a href='#'>";
            echo "<img src='$photo' alt='$name'>";
            echo "<span>$name</span>";
            echo "<p>$position</p>";
            echo "</a>";

            // Recursive call to fetch children
            buildHierarchy($row['id'], $conn);

            echo "</li>";
        }
        echo "</ul>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - TechCare</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="../css/aboutUs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="shortcut icon" href="images/techcareLogo2.png" type="image/x-icon">
</head>

<body>
    <!-- Navbar -->
    <?php include 'navbar.php' ?>
    <?php include "data/about_us.php" ?>

    <!-- Header Section -->
    <div class="main">
        <script>
        let bg_img = document.querySelector('.main');
        <?php
        if ($headerPic !== null) {
            $imageType = strpos($headerPic, '/png') !== false ? 'png' : 'jpeg';
            echo "bg_img.style.backgroundImage = 'url(\"data:image/{$imageType};base64," . base64_encode($headerPic) . "\")';";
        } else {
            echo "bg_img.style.backgroundImage = 'url(\"default_image.jpg\")';";
        }
        ?>
        </script>

        <div class="contentbg">
            <div class="content">
                <h1 style="text-transform: uppercase;">ABOUT US</h1>
                <div class="route">
                    <span><a href="index.php">Home</a></span>
                    <p>&nbsp;/&nbsp;About </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Chairman Info -->
    <div class="chairCont">
        <div class="chairImg">
            <?php
            if ($sectionPic !== null) {
                $imageType = strpos($sectionPic, '/png') !== false ? 'png' : 'jpeg';
                echo "<img src='data:image/{$imageType};base64," . base64_encode($sectionPic). "' />";
            } else {
                echo "No image available";
            }
            ?>
        </div>
        <div class="chairDits">
            <h1><?php echo $sectionHead; ?></h1>
            <h3><?php echo $sectionSubhead; ?></h3>
            <p><?php echo $sectionBody; ?></p>
        </div>
    </div>

    <!-- Mission Vision -->
    <div class="mvCont">
        <div class="mission">
            <div class="mvText">
                <h1>Mission</h1>
                <p><?php echo $mission; ?></p>
            </div>
            <div class="mvPic">
                <?php
                if ($missionPic !== null) {
                    $imageType = strpos($missionPic, '/png') !== false ? 'png' : 'jpeg';
                    echo "<img src='data:image/{$imageType};base64," . base64_encode($missionPic). "' />";
                } else {
                    echo "No image available";
                }
                ?>
            </div>
        </div>
        <div class="vision">
            <div class="mvPic">
                <?php
                if ($visionPic !== null) {
                    $imageType = strpos($visionPic, '/png') !== false ? 'png' : 'jpeg';
                    echo "<img src='data:image/{$imageType};base64," . base64_encode($visionPic). "' />";
                } else {
                    echo "No image available";
                }
                ?>
            </div>
            <div class="mvText">
                <h1>Vision</h1>
                <p><?php echo $vision; ?></p>
            </div>
        </div>
    </div>

    <!-- Org Chart Section -->
    <div class="orgCont">
        <div class="orgTitle">
            <h1>Barangay Nutrition Committee</h1>
            <p>Get to Know the Barangay Nutrition Committee</p>
        </div>
        <div class="tree">
            <?php
            // Render the org chart
            buildHierarchy(null, $conn);
            ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php' ?>

</body>

</html>
