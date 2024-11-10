<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programs - TechCare</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="../css/programs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="shortcut icon" href="images/techcareLogo2.png" type="image/x-icon">
</head>

<body>
    <!-- Navbar -->
    <?php include "data/home.php" ?>
    <?php include 'navbar.php' ?>

    <!-- Header -->
    <div class="main">
        <script>
        let bg_img = document.querySelector('.main');
        <?php
        // Assuming $bgImg contains the image data
        if ($programsPic !== null) {
            $imageType = strpos($programsPic, '/png') !== false ? 'png' : 'jpeg';
            echo "bg_img.style.backgroundImage = 'url(\'data:image/{$imageType};base64," . base64_encode($programsPic) . "\')';";
        } else {
            echo "// Handle case when no image is available";
        }
    ?>
        </script>
        <div class="contentbg">
            <div class="content">
                <h1 style="text-transform: uppercase;">PROGRAMS</h1>
                <div class="route">
                    <span><a href="index.php"> Home </a></span>
                    <p>&nbsp;/&nbsp;Programs</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories -->
    <div class="tabbed-container">
        <div class="tabs">
            <button class="tab-btn active" data-tab="tab1">ALL PROGRAMS</button>
            <button class="tab-btn" data-tab="tab2">BASIC HEALTHCARE</button>
            <button class="tab-btn" data-tab="tab3">PRE & POST NATAL CARE</button>
            <button class="tab-btn" data-tab="tab4">FAMILY PLANNING</button>
            <button class="tab-btn" data-tab="tab5">IMMUNIZATION</button>
            <button class="tab-btn" data-tab="tab6">VACCINATIONS</button>
            <button class="tab-btn" data-tab="tab7">NUTRITION PROGRAM</button>
            <button class="tab-btn" data-tab="tab8">OTHERS</button>
        </div>

        <?php include "../fetchContent.php"; ?>
        <!-- Content for Tab 1 (All Programs) -->
        <div class="tab-content active" id="tab1">
            <?php foreach ($allPrograms as $program) : ?>
            <div class="prcon" onclick="openProgramContent(<?php echo $program['id']; ?>)">
                <div class="prcontent">
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
                        <?php
                        // Maximum number of characters to display for three lines
                        $maxChars = 120;

                        // Get the program body
                        $programBody = $program['prog_body'];

                        // Check if the length of the program body is greater than the maximum characters allowed
                        if (strlen($programBody) > $maxChars) {
                            // Truncate the program body to the maximum number of characters
                            $truncatedProgramBody = substr($programBody, 0, $maxChars);

                            // Find the position of the last space within the truncated text
                            $lastSpace = strrpos($truncatedProgramBody, ' ');

                            // If a space was found, truncate the text at that position
                            if ($lastSpace !== false) {
                                $truncatedProgramBody = substr($truncatedProgramBody, 0, $lastSpace);
                            }

                            // Add ellipsis (...) to indicate truncation
                            $truncatedProgramBody .= '...';
                        } else {
                            // If the program body is within the character limit, no need to truncate
                            $truncatedProgramBody = $programBody;
                        }
                        ?>

                        <p><?php echo $truncatedProgramBody; ?></p>

                    </div>
                    <p style="font-size: x-small; color: #888D8F;"><?php echo $program['program_type']; ?></p>
                </div>
                <?php
                    if ($program['prog_pic'] !== null) {
                      $imageType = strpos($program['prog_pic'], '/png') !== false ? 'png' : 'jpeg';
                      echo "<img src='data:image/{$imageType};base64," . base64_encode($program['prog_pic']). "' />";
                    } else {
                      echo "No image available";
                    }
                    ?>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Content for Tab 2 (Basic Healthcare) -->
        <div class="tab-content" id="tab2">
            <?php foreach ($basicHealthcarePrograms as $program) : ?>
            <div class="prcon" onclick="openProgramContent(<?php echo $program['id']; ?>)">
                <div class="prcontent">
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
                        <?php
                        // Maximum number of characters to display for three lines
                        $maxChars = 120;

                        // Get the program body
                        $programBody = $program['prog_body'];

                        // Check if the length of the program body is greater than the maximum characters allowed
                        if (strlen($programBody) > $maxChars) {
                            // Truncate the program body to the maximum number of characters
                            $truncatedProgramBody = substr($programBody, 0, $maxChars);

                            // Find the position of the last space within the truncated text
                            $lastSpace = strrpos($truncatedProgramBody, ' ');

                            // If a space was found, truncate the text at that position
                            if ($lastSpace !== false) {
                                $truncatedProgramBody = substr($truncatedProgramBody, 0, $lastSpace);
                            }

                            // Add ellipsis (...) to indicate truncation
                            $truncatedProgramBody .= '...';
                        } else {
                            // If the program body is within the character limit, no need to truncate
                            $truncatedProgramBody = $programBody;
                        }
                        ?>

                        <p><?php echo $truncatedProgramBody; ?></p>
                    </div>
                    <p style="font-size: x-small; color: #888D8F;"><?php echo $program['program_type']; ?></p>
                </div>
                <?php
                    if ($program['prog_pic'] !== null) {
                      $imageType = strpos($program['prog_pic'], '/png') !== false ? 'png' : 'jpeg';
                      echo "<img src='data:image/{$imageType};base64," . base64_encode($program['prog_pic']). "' />";
                    } else {
                      echo "No image available";
                    }
                    ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="tab-content" id="tab3">
            <?php foreach ($prePostNatalCarePrograms as $program) : ?>
            <div class="prcon" onclick="openProgramContent(<?php echo $program['id']; ?>)">
                <div class="prcontent">
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
                        <?php
                        // Maximum number of characters to display for three lines
                        $maxChars = 120;

                        // Get the program body
                        $programBody = $program['prog_body'];

                        // Check if the length of the program body is greater than the maximum characters allowed
                        if (strlen($programBody) > $maxChars) {
                            // Truncate the program body to the maximum number of characters
                            $truncatedProgramBody = substr($programBody, 0, $maxChars);

                            // Find the position of the last space within the truncated text
                            $lastSpace = strrpos($truncatedProgramBody, ' ');

                            // If a space was found, truncate the text at that position
                            if ($lastSpace !== false) {
                                $truncatedProgramBody = substr($truncatedProgramBody, 0, $lastSpace);
                            }

                            // Add ellipsis (...) to indicate truncation
                            $truncatedProgramBody .= '...';
                        } else {
                            // If the program body is within the character limit, no need to truncate
                            $truncatedProgramBody = $programBody;
                        }
                        ?>

                        <p><?php echo $truncatedProgramBody; ?></p>
                    </div>
                    <p style="font-size: x-small; color: #888D8F;"><?php echo $program['program_type']; ?></p>
                </div>
                <?php
                    if ($program['prog_pic'] !== null) {
                      $imageType = strpos($program['prog_pic'], '/png') !== false ? 'png' : 'jpeg';
                      echo "<img src='data:image/{$imageType};base64," . base64_encode($program['prog_pic']). "' />";
                    } else {
                      echo "No image available";
                    }
                    ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="tab-content" id="tab4">
            <?php foreach ($familyPlanningPrograms as $program) : ?>
            <div class="prcon" onclick="openProgramContent(<?php echo $program['id']; ?>)">
                <div class="prcontent">
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
                        <?php
                        // Maximum number of characters to display for three lines
                        $maxChars = 120;

                        // Get the program body
                        $programBody = $program['prog_body'];

                        // Check if the length of the program body is greater than the maximum characters allowed
                        if (strlen($programBody) > $maxChars) {
                            // Truncate the program body to the maximum number of characters
                            $truncatedProgramBody = substr($programBody, 0, $maxChars);

                            // Find the position of the last space within the truncated text
                            $lastSpace = strrpos($truncatedProgramBody, ' ');

                            // If a space was found, truncate the text at that position
                            if ($lastSpace !== false) {
                                $truncatedProgramBody = substr($truncatedProgramBody, 0, $lastSpace);
                            }

                            // Add ellipsis (...) to indicate truncation
                            $truncatedProgramBody .= '...';
                        } else {
                            // If the program body is within the character limit, no need to truncate
                            $truncatedProgramBody = $programBody;
                        }
                        ?>

                        <p><?php echo $truncatedProgramBody; ?></p>
                    </div>
                    <p style="font-size: x-small; color: #888D8F;"><?php echo $program['program_type']; ?></p>
                </div>
                <?php
                    if ($program['prog_pic'] !== null) {
                      $imageType = strpos($program['prog_pic'], '/png') !== false ? 'png' : 'jpeg';
                      echo "<img src='data:image/{$imageType};base64," . base64_encode($program['prog_pic']). "' />";
                    } else {
                      echo "No image available";
                    }
                    ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="tab-content" id="tab5">
            <?php foreach ($immunizationPrograms as $program) : ?>
            <div class="prcon" onclick="openProgramContent(<?php echo $program['id']; ?>)">
                <div class="prcontent">
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
                        <?php
                        // Maximum number of characters to display for three lines
                        $maxChars = 120;

                        // Get the program body
                        $programBody = $program['prog_body'];

                        // Check if the length of the program body is greater than the maximum characters allowed
                        if (strlen($programBody) > $maxChars) {
                            // Truncate the program body to the maximum number of characters
                            $truncatedProgramBody = substr($programBody, 0, $maxChars);

                            // Find the position of the last space within the truncated text
                            $lastSpace = strrpos($truncatedProgramBody, ' ');

                            // If a space was found, truncate the text at that position
                            if ($lastSpace !== false) {
                                $truncatedProgramBody = substr($truncatedProgramBody, 0, $lastSpace);
                            }

                            // Add ellipsis (...) to indicate truncation
                            $truncatedProgramBody .= '...';
                        } else {
                            // If the program body is within the character limit, no need to truncate
                            $truncatedProgramBody = $programBody;
                        }
                        ?>

                        <p><?php echo $truncatedProgramBody; ?></p>
                    </div>
                    <p style="font-size: x-small; color: #888D8F;"><?php echo $program['program_type']; ?></p>
                </div>
                <?php
                    if ($program['prog_pic'] !== null) {
                      $imageType = strpos($program['prog_pic'], '/png') !== false ? 'png' : 'jpeg';
                      echo "<img src='data:image/{$imageType};base64," . base64_encode($program['prog_pic']). "' />";
                    } else {
                      echo "No image available";
                    }
                    ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="tab-content" id="tab6">
            <?php foreach ($vaccinationsPrograms as $program) : ?>
            <div class="prcon" onclick="openProgramContent(<?php echo $program['id']; ?>)">
                <div class="prcontent">
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
                        <?php
                        // Maximum number of characters to display for three lines
                        $maxChars = 120;

                        // Get the program body
                        $programBody = $program['prog_body'];

                        // Check if the length of the program body is greater than the maximum characters allowed
                        if (strlen($programBody) > $maxChars) {
                            // Truncate the program body to the maximum number of characters
                            $truncatedProgramBody = substr($programBody, 0, $maxChars);

                            // Find the position of the last space within the truncated text
                            $lastSpace = strrpos($truncatedProgramBody, ' ');

                            // If a space was found, truncate the text at that position
                            if ($lastSpace !== false) {
                                $truncatedProgramBody = substr($truncatedProgramBody, 0, $lastSpace);
                            }

                            // Add ellipsis (...) to indicate truncation
                            $truncatedProgramBody .= '...';
                        } else {
                            // If the program body is within the character limit, no need to truncate
                            $truncatedProgramBody = $programBody;
                        }
                        ?>

                        <p><?php echo $truncatedProgramBody; ?></p>
                    </div>
                    <p style="font-size: x-small; color: #888D8F;"><?php echo $program['program_type']; ?></p>
                </div>
                <?php
                    if ($program['prog_pic'] !== null) {
                      $imageType = strpos($program['prog_pic'], '/png') !== false ? 'png' : 'jpeg';
                      echo "<img src='data:image/{$imageType};base64," . base64_encode($program['prog_pic']). "' />";
                    } else {
                      echo "No image available";
                    }
                    ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="tab-content" id="tab7">
            <?php foreach ($nutritionPrograms as $program) : ?>
            <div class="prcon" onclick="openProgramContent(<?php echo $program['id']; ?>)">
                <div class="prcontent">
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
                        <?php
                        // Maximum number of characters to display for three lines
                        $maxChars = 120;

                        // Get the program body
                        $programBody = $program['prog_body'];

                        // Check if the length of the program body is greater than the maximum characters allowed
                        if (strlen($programBody) > $maxChars) {
                            // Truncate the program body to the maximum number of characters
                            $truncatedProgramBody = substr($programBody, 0, $maxChars);

                            // Find the position of the last space within the truncated text
                            $lastSpace = strrpos($truncatedProgramBody, ' ');

                            // If a space was found, truncate the text at that position
                            if ($lastSpace !== false) {
                                $truncatedProgramBody = substr($truncatedProgramBody, 0, $lastSpace);
                            }

                            // Add ellipsis (...) to indicate truncation
                            $truncatedProgramBody .= '...';
                        } else {
                            // If the program body is within the character limit, no need to truncate
                            $truncatedProgramBody = $programBody;
                        }
                        ?>

                        <p><?php echo $truncatedProgramBody; ?></p>
                    </div>
                    <p style="font-size: x-small; color: #888D8F;"><?php echo $program['program_type']; ?></p>
                </div>
                <?php
                    if ($program['prog_pic'] !== null) {
                      $imageType = strpos($program['prog_pic'], '/png') !== false ? 'png' : 'jpeg';
                      echo "<img src='data:image/{$imageType};base64," . base64_encode($program['prog_pic']). "' />";
                    } else {
                      echo "No image available";
                    }
                    ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="tab-content" id="tab8">
            <?php foreach ($othersPrograms as $program) : ?>
            <div class="prcon" onclick="openProgramContent(<?php echo $program['id']; ?>)">
                <div class="prcontent">
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
                        <?php
                        // Maximum number of characters to display for three lines
                        $maxChars = 120;

                        // Get the program body
                        $programBody = $program['prog_body'];

                        // Check if the length of the program body is greater than the maximum characters allowed
                        if (strlen($programBody) > $maxChars) {
                            // Truncate the program body to the maximum number of characters
                            $truncatedProgramBody = substr($programBody, 0, $maxChars);

                            // Find the position of the last space within the truncated text
                            $lastSpace = strrpos($truncatedProgramBody, ' ');

                            // If a space was found, truncate the text at that position
                            if ($lastSpace !== false) {
                                $truncatedProgramBody = substr($truncatedProgramBody, 0, $lastSpace);
                            }

                            // Add ellipsis (...) to indicate truncation
                            $truncatedProgramBody .= '...';
                        } else {
                            // If the program body is within the character limit, no need to truncate
                            $truncatedProgramBody = $programBody;
                        }
                        ?>

                        <p><?php echo $truncatedProgramBody; ?></p>
                    </div>
                    <p style="font-size: x-small; color: #888D8F;"><?php echo $program['program_type']; ?></p>
                </div>
                <?php
                    if ($program['prog_pic'] !== null) {
                      $imageType = strpos($program['prog_pic'], '/png') !== false ? 'png' : 'jpeg';
                      echo "<img src='data:image/{$imageType};base64," . base64_encode($program['prog_pic']). "' />";
                    } else {
                      echo "No image available";
                    }
                    ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php' ?>

    <!-- ===============================scripts================================== -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Hide all tab contents
                tabContents.forEach(content => {
                    content.classList.remove('active');
                });

                // Deactivate all tabs
                tabs.forEach(tab => {
                    tab.classList.remove('active');
                });

                // Show the clicked tab content
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');

                // Activate the clicked tab
                this.classList.add('active');
            });
        });
    });
    </script>
    <script>
    function openProgramContent(programId) {
        window.location.href = 'programContent.php?id=' + programId;
    }
    </script>
</body>

</html>