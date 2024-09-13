<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - CareVisio</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="../css/aboutUs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="shortcut icon" href="../src/favicon.png" type="image/x-icon">
</head>

<body>
    <!-- Navbar -->
    <?php include 'navbar.php' ?>
    <?php include "data/about_us.php" ?>
    <!-- Header -->
    <div class="main">
        <script>
        let bg_img = document.querySelector('.main');
        <?php
    // Check if $headerPic exists
    if ($headerPic !== null) {
        $imageType = strpos($headerPic, '/png') !== false ? 'png' : 'jpeg';
        echo "bg_img.style.backgroundImage = 'url(\'data:image/{$imageType};base64," . base64_encode($headerPic) . "\')';";
    } else {
        // Provide a default background image if $headerPic is not available
        echo "bg_img.style.backgroundImage = 'url(\'default_image.jpg\')';";
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
              if ($sectionPic !== null) {
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
              if ($sectionPic !== null) {
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

    <!-- Health Personnel -->
    <div class="healthPersonnel">
        <div class="hpTitle">
            <h1>Barangay Health Team</h1>
            <p>Meet the Barangay Bagumbayan Health Team</p>
        </div>
        <div class="wrapper">
            <i id="left" class="fas fa-chevron-left"></i>
            <ul class="carousel">
                <?php
            include "dbcon.php";

            $sql = "SELECT * FROM brgy_health";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li class='card'>";
                    echo "<div class='img'>";
                    if ($row["pic"] !== null) {
                        $imageType = strpos($row["pic"], '/png') !== false ? 'png' : 'jpeg';
                        echo "<img src='data:image/{$imageType};base64," . base64_encode($row["pic"]). "' alt='Image' draggable='false' />";
                    } else {
                        echo "No image available";
                    }
                    echo "</div>";
                    echo "<h2>" . $row["name"] . "</h2>";
                    echo "<span>" . $row["position"] . "</span>";
                    echo "</li>";
                }
            }
            
            ?>
            </ul>
            <i id="right" class="fas fa-chevron-right"></i>
        </div>
    </div>

    <!-- Org Chart -->
    <div class="orgCont">
        <div class="orgTitle">
            <h1>Barangay Nutrition Committee</h1>
            <p>Get to Know the Barangay Bagumbayan Nutrition Committee</p>
        </div>
        <div class="tree">
            <ul>
                <li><a href=""><img src="../src/chairman.jpg"><span>Rosini M. Lubiano</span>
                        <p>Chairman</p>
                    </a>
                    <ul>
                        <li><a href=""><img src="../src/health_chairman.png"><span>Hon. Mark C. Magalona</span>
                                <p>Chairman Committee on Health</p>
                            </a>
                            <ul>
                                <li><a href=""><img src="../src/environmental_councilor.png"><span>Hon. Basilio E. Meiliano</span>
                                        <p>Councilor on Environmental Sanitation</p>
                                    </a></li>
                                <li><a href=""><img src="../src/bhw.jpg"><span>Milani L. Anaban</span>
                                        <p>BNS</p>
                                    </a>
                                    <ul>
                                    <li><a href=""><span>Barangay Councilors</span>
                                                <p>Hon. Janna M. Rabulan</p>
                                                <p>Hon. Emily J. Macarinas</p>
                                                <p>Hon. Joshua O. Bolivia</p>
                                                <p>Hon. Sandy Y. Nebres</p>
                                                <p>Hon. Robert L. Santos</p>
                                            </a></li>
                                        <li><a href=""><span>Day Care Worker</span>
                                                <p>Lara P. Marbella</p>
                                                <p>Jona W. Beldad</p>
                                                <p>Nica F. Vargas</p>
                                            </a></li>
                                        <li><a href=""><span>Barangay Health Workers</span>
                                                <p>Queenie S. Tonga</p>
                                                <p>Jessa K. Llaguno</p>
                                                <p>Claudine T. Ignacio</p>
                                                <p>Denise C. Cruz</p>
                                                <p>Caryle U. Velasco</p>
                                                <p>Ella L. Montes</p>
                                                <p>Bia G. Hernandez</p>
                                                <p>Jackie H. Ferrer</p>
                                                <p>Casey D. Herrera</p>
                                            </a></li>
                                    </ul>
                                </li>
                                <li><a href=""><img src="../src/nurse.jpg"><span>Emerose C. Tonga, RN</span>
                                        <p>NDP-Nurse II</p>
                                    </a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php' ?>

    <!-- ===============================scripts================================== -->
    <script>
    function showContent(index) {
        var elements = document.getElementsByClassName('mvgDetails');
        var buttons = document.getElementsByClassName('mvg');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
            buttons[i].style.backgroundColor = '';
            buttons[i].style.boxShadow = '';
            buttons[i].style.fontWeight = '';
        }
        elements[index].style.display = 'block';
        buttons[index].style.backgroundColor = 'white';
        buttons[index].style.boxShadow = '1px 1px 3px rgba(0, 0, 0, 0.5)';
        buttons[index].style.fontWeight = 'bold';
    }
    showContent(0);
    </script>
    <script>
    const carousel = document.querySelector(".carousel")
    const arrowBtns = document.querySelectorAll(".wrapper i")
    const firstCardWidth = carousel.querySelector(".card").offsetWidth;
    let isDragging = false,
        startX, startScrollLeft;

    arrowBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            carousel.scrollLeft += btn.id === "left" ? -firstCardWidth : firstCardWidth;
        })
    })

    const dragStart = (e) => {
        isDragging = true;
        carousel.classList.add("dragging");
        startX = e.pageX;
        startScrollLeft = carousel.scrollLeft
    }

    const dragging = (e) => {
        if (!isDragging) return;
        carousel.scrollLeft = startScrollLeft - (e.pageX - startX);
    }

    const dragStop = () => {
        isDragging = false;
        carousel.classList.remove("dragging");
    }

    carousel.addEventListener("mousedown", dragStart);
    carousel.addEventListener("mousemove", dragging);
    document.addEventListener("mouseup", dragStop);
    </script>
</body>

</html>