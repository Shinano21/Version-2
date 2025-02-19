<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - TechCare</title>
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="shortcut icon" href="images/techcareLogo2.png" type="image/x-icon">
</head>

<body>
    <!-- Navbar -->
    <?php include 'navbar.php';?>
    <?php include "data/home.php" ?>
    <!-- Header -->
    <div class="main"  id="mainHeader" style="
    background-image: url('<?php
        // Adjusting the path for the background image
        if (isset($bgImg) && !empty($bgImg)) {
            echo '../admin/cms/uploads/' . $bgImg; // Update the path to match your directory structure
        } else {
            echo 'default-image.png'; // Use a default image if no image is found
        }
    ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">

        <div class="contentbg">
            <div class="content">
                <div class="texts">
                    <h2>OFFICIAL WEBSITE OF</h2>
                    <h1><?php echo $centerName ?></h1>
                    <p class="address">
                        <a href="http://maps.google.com/?q=<?php echo isset($address) ? $address : '#'; ?>" target="_blank" style="text-decoration:none;color:white;">
                            <?php echo isset($address) ? $address : "Address unavailable"; ?>
                        </a>
                    </p>
                    <p class="contactInfo">
                       
                    </p> 
                    <button><a href="aboutUs.php">Learn More <i class="fas fa-arrow-right" id="i"></i></a></button>
                </div>
                <!-- <div class="brgy">
                    <?php
                    if ($logoPic !== null) {
                        $imageType = strpos($logoPic, '/png') !== false ? 'png' : 'jpeg';
                        echo "<img src='data:image/{$imageType};base64," . base64_encode($logoPic). "' />";
                    } else {
                        echo "No image available";
                    }
                    ?>
                </div> -->
            </div>
        </div>
    </div>

    <!-- Schedule -->
    <div class="divide"><?php echo $openHours ?></div>

    <!-- About Us -->
    <div class="abtUs">
        <div class="abtImg">
            <?php
              if ($sectionPic !== null) {
                $imageType = strpos($sectionPic, '/png') !== false ? 'png' : 'jpeg';
            echo "<img src='../admin/cms/{$sectionPic}' style='max-width: 100%; height: auto;' />";
               
              } else {
                echo "No image available";
              }
              ?>
        </div>
        <div class="abtDetails">
            <h2>About us</h2>
            <p class="gray_text"><?php echo $shortDesc ?></p>
            <div style="margin-top: 5%;">
                <button onclick="showContent(0)" class="mvg">Our Mission</button>
                <button onclick="showContent(1)" class="mvg">Our Vision</button>
                <button onclick="showContent(2)" class="mvg">Our Goal</button>
            </div>

            <div class="mvgDetails">
                <p>
                    <?php echo $mission ?>
                </p>
            </div>
            <div class="mvgDetails">
                <p>
                    <?php echo $vision ?>
                </p>
            </div>
            <div class="mvgDetails">
                <p>
                    <?php echo $goal ?>
                </p>
            </div>
            <div class="per">
                <div class="per1">
                    <?php
              if ($chairmanPic !== null) {
                $imageType = strpos($chairmanPic, '/png') !== false ? 'png' : 'jpeg';
                echo "<img src='../admin/cms/{$chairmanPic}' style='width: 150px; height: auto; object-fit: contain;' />";
              } else {
                echo "No image available";
              }
              ?>
                    <div class="perText">
                        <p class="title">Chairman</p>
                        <p class="name"><?php echo $chairman ?></p>
                    </div>
                </div>
                <div class="per2">
                    <?php
                    if ($chairmanCommPic !== null) {
                      $imageType = strpos($chairmanCommPic, '/png') !== false ? 'png' : 'jpeg';
                      echo "<img src='../admin/cms/{$chairmanCommPic}' style='width: 150px; height: auto; object-fit: contain;' />";
                      
                    } else {
                      echo "No image available";
                    }
                    ?>
                    <div class="perText">
                        <p class="title">Chairman Committee on Health</p>
                        <p class="name"><?php echo $chairmanComm ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Health Team -->
    <div class="healthPersonnel">
        <div class="htTitle">
            <h2>Barangay Health Team</h2>
            <p>Meet the <?php echo $centerName ?> Team</p>
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
                         // Use the stored filename to construct the image path
                $imagePath = "../admin/cms/uploads/" . htmlspecialchars($row["pic"]);
                echo "<img src='$imagePath' alt='Image of {$row['name']}' draggable='false' />";
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

    <!-- Bar of Programs -->
    <div class="program-container">
        <div class="prog">
            <div class="program">
                <img src="../src/healthcare.png">
                <p>Basic Healthcare</p>
            </div>
            <div class="program">
                <img src="../src/maternal.png">
                <p>Post-natal Care</p>
            </div>
            <div class="program">
                <img src="../src/family.png">
                <p>Family Planning</p>
            </div>
            <div class="program">
                <img src="../src/vaccination.png">
                <p>Immunizations and Vaccinations</p>
            </div>
            <div class="program">
                <img src="../src/nutrition.png">
                <p>Nutrition Program</p>
            </div>
        </div>
    </div>

   <!-- Health Programs -->
   <div class="hpCont">
    <div class="hpTitle">
        <h2>Health Programs</h2>
        <p>
            <?php 
            if (isset($centerName) && !empty($centerName)) {
                echo "Latest Health Programs of " . $centerName;
            } else {
                echo "Center name unavailable";
            }
            ?>
        </p>
    </div>
    <div class="hpCardCont">
    <style>
        .hpCardCont {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .hpCard {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .imgCont img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            object-fit: cover;
        }
        .pgHeading {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }
        .postDate {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }
        .hpCard button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .hpCard button:hover {
            background-color: #0056b3;
        }
    </style>

    <?php
    $sql = "SELECT * FROM programs ORDER BY post_date DESC LIMIT 3";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <div class="hpCard">
        <div class="imgCont">
        <?php
        if ($row['prog_pic'] !== null && file_exists("../admin/cms/uploads/" . $row['prog_pic'])) {
            echo "<img src='../admin/cms/uploads/" . htmlspecialchars($row['prog_pic'], ENT_QUOTES, 'UTF-8') . "' alt='Program Image' />";
        } else {
            echo "<div>No image available</div>";
        }
        ?>
        </div>
        <p class="pgHeading"><?php echo $row["prog_heading"]; ?></p>
        <p class="postDate">
            <?php 
                $post_datetime_12hr = date("Y-m-d h:i A", strtotime($row['post_date']));
                echo $post_datetime_12hr; 
            ?>
        </p>
        <button onclick="window.location.href='programContent.php?id=<?php echo $row['id']?>'">View More</button>
    </div>
    <?php
        }
    } else {
        echo "<p>No health programs available at the moment.</p>";
    }
    ?>
</div>
    </div>

    <!-- Health Announcements -->
    <div class="hpCont">
        <div class="hpTitle">
            <h2>Health Announcements</h2>
            <p>Be Updated with the Barangay Health Announcements</p>
        </div>
        <div class="hpCardCont">
            <?php
            $sql = "SELECT * FROM announcements ORDER BY post_date DESC LIMIT 3";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="hpCard">
                <div class="imgCont">
                    <?php
                if ($row["announce_pic"] !== null) {
                    $imageType = strpos($row["announce_pic"], '/png') !== false ? 'png' : 'jpeg';
                    echo "<img src='../admin/cms/uploads/" . htmlspecialchars($row['announce_pic'], ENT_QUOTES, 'UTF-8') . "' alt='Program Image' />";
                } else {
                    echo "<img src='../src/default_image.png' alt='Default Image'>";
                }
                ?>
                </div>

                <p class="pgHeading"><?php echo $row["announce_heading"]; ?></p>
                <p class="postDate">
                    <?php 
                        // Convert military time to 12-hour format
                        $post_datetime_12hr = date("Y-m-d h:i A", strtotime($row['post_date']));
                        echo $post_datetime_12hr; 
                    ?>
                </p>
                <button onclick="window.location.href='announcementsContent.php?id=<?php echo $row['id']?>'">View More</button>
            </div>
            <?php
            }
            ?>
        </div>

    </div>


    <!-- Contact Us -->
    <div class="cusCont">
        <div class="getCont">
            <div class="getText">
                <p>Get in touch with us</p>
                <span><?php echo $contactMess ?></span>
                <div class="sccu">
                    <div class="sch"><?php echo $officeHrs ?></div>
                    <div class="cu" onclick="window.location.href='contactUs.php'">Contact Us</div>
                </div>
            </div>
            <img src="../src/cc.png" alt="Connectivity">
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