<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - TechCare</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/aboutUs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>
    <?php include "user/data/about_us.php"; ?>

    <!-- Header Section -->
    <div class="main">
        <div class="contentbg">
            <div class="content">
                <h1>ABOUT US</h1>
                <div class="route">
                    <span><a href="index.php"> Home </a></span>
                    <p>&nbsp;/&nbsp;About </p>
                </div>
            </div>
        </div>

        <script>
            let bg_img = document.querySelector('.main');
            <?php
            if ($headerPic !== null) {
                echo "bg_img.style.backgroundImage = 'url(\"images/bnc/$headerPic\")';";
            } else {
                echo "bg_img.style.backgroundImage = 'url(\"default_image.jpg\")';";
            }
            ?>
        </script>
    </div>

    <!-- Chairman Info Section -->
    <div class="chairCont">
        <div class="chairImg">
            <?php
            if ($sectionPic !== null) {
                echo "<img src='images/bnc/$sectionPic' alt='Chairman Image'>";
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

    <!-- Mission and Vision Section -->
    <div class="mvCont">
        <div class="mission">
            <div class="mvText">
                <h1>Mission</h1>
                <p><?php echo $mission; ?></p>
            </div>
            <div class="mvPic">
                <?php
                if ($missionPic !== null) {
                    echo "<img src='images/bnc/$missionPic' alt='Mission Image'>";
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
                    echo "<img src='images/bnc/$visionPic' alt='Vision Image'>";
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

    <!-- Organization Chart Section -->
    <div class="orgCont">
        <div class="orgTitle">
            <h1>Barangay Nutrition Committee</h1>
            <p>Get to Know the Barangay Nutrition Committee</p>
        </div>
        <div class="tree">
            <?php
            include "dbcon.php";

            // Recursive function to build the organizational chart
            function buildHierarchy($parent_id = null, $conn) {
                $sql = "SELECT * FROM organization WHERE parent_id " . ($parent_id === null ? "IS NULL" : "= $parent_id");
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "<ul>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $photo = $row['photo'] ? "images/bnc/" . $row['photo'] : "src/default_avatar.png";
                        
                        echo "<li>";
                        echo "<a href='#'>";
                        echo "<img src='{$photo}' alt='{$row['name']}'>";
                        echo "<span>{$row['name']}</span>";
                        echo "<p>{$row['position']}</p>";
                        echo "</a>";

                        // Recursive call for children
                        buildHierarchy($row['id'], $conn);

                        echo "</li>";
                    }
                    echo "</ul>";
                }
            }

            // Build the hierarchy starting from the top-level nodes
            buildHierarchy(null, $conn);
            ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>

</html>
