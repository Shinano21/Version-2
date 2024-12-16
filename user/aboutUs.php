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
            $photo = $row['photo'] ? "../admin/images/bnc/" . $row['photo'] : "../admin/images/default_avatar.png";

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
        echo "bg_img.style.backgroundImage = 'url(\"../admin/cms/uploads/$headerPic\")';";
    } else {
        echo "bg_img.style.backgroundImage = 'url(\"../admin/images/default_image.jpg\")';";
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

        <!-- Chairman Info Section -->
        <div class="chairCont">
    <div class="chairImg">
    <?php
    $imagePath = $sectionPic ? "../admin/cms/uploads/$sectionPic" : "../admin/images/default_avatar.png";
    echo "<img src='$imagePath' alt='Chairman Image'>";
    ?>
</div>

        <div class="chairDits">
            <h1><?php echo htmlspecialchars($sectionHead); ?></h1>
            <h3><?php echo htmlspecialchars($sectionSubhead); ?></h3>
            <p><?php echo htmlspecialchars($sectionBody); ?></p>
        </div>
    </div>

<!-- Mission and Vision Section -->
<div class="mvCont">
    <!-- Mission Section -->
    <div class="mission">
        <div class="mvText">
            <h1>Mission</h1>
            <p><?php echo htmlspecialchars($mission); ?></p>
        </div>
        <div class="mvPic">
            <?php
            $missionImagePath = !empty($missionPic) ? "../admin/cms/uploads/$missionPic" : "admin/images/default_image.jpg";
            ?>
            <img src="<?php echo $missionImagePath; ?>" alt="Mission Image">
        </div>
    </div>
    <!-- Vision Section -->
    <div class="vision">
        <div class="mvPic">
            <?php
            $visionImagePath = !empty($visionPic) ? "../admin/cms/uploads/$visionPic" : "../admin/images/default_image.jpg";
            ?>
            <img src="<?php echo $visionImagePath; ?>" alt="Vision Image">
        </div>
        <div class="mvText">
            <h1>Vision</h1>
            <p><?php echo htmlspecialchars($vision); ?></p>
        </div>
    </div>
</div>
    </div>

   <!-- Organization Chart Section -->
   <div class="orgCont">
        <div class="orgTitle">
            <h1>Barangay Nutrition Committee</h1>
            <p>Get to Know the Barangay Nutrition Committee</p>
        </div>
        <div class="tree">
            <?php
            // Build the hierarchy starting from the top-level nodes
            buildHierarchy(null, $conn);
            ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php' ?>

</body>

</html>
