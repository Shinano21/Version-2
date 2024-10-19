<header class="nav">
    <?php
    session_start();
    include "data/logo.php";

    if (isset($_SESSION['unique_id'])) {
        echo "<script>console.log('User session found');</script>";
    } else {
        echo "<script>console.log('No user session found');</script>";
    }
    
    
    if (isset($_SESSION['unique_id'])) {
        $unique_id = $_SESSION['unique_id'];
        
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '$unique_id'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
        } else {
            // Handle case where no user is found
            $row = null;
        }
    } else {
        // Handle case where unique_id is not set in session
        $row = null;
    }

    
    ?>
    <div class="nav-container">
        <a class="logo" href="index.php">
            <img src="../src/logo.svg" alt="Logo">
            <!-- <?php
            if ($navbarLogo !== null) {
                $imageType = strpos($navbarLogo, '/png') !== false ? 'png' : 'jpeg';
                echo "<img src='data:image/{$imageType};base64," . base64_encode($navbarLogo). "' />";
            } else {
                echo "No image available";
            }
            ?> delete <img src="../src/logo.png" alt="Logo"> and uncomment
            the above block if you want to modify both logo of user and guest -->
        </a>
        <div class="nav-links">
            <a href="index.php" <?php if(strpos($_SERVER['REQUEST_URI'], 'index.php') !== false) echo 'class="active"'; ?>>HOME</a>
            <a href="aboutUs.php" <?php if(strpos($_SERVER['REQUEST_URI'], 'aboutUs.php') !== false) echo 'class="active"'; ?>>ABOUT</a>
            <a href="programs.php" <?php if(strpos($_SERVER['REQUEST_URI'], 'programs.php') !== false || strpos($_SERVER['REQUEST_URI'], 'programContent.php') !== false) echo 'class="active"'; ?>>PROGRAMS</a>
            <a href="announcements.php" <?php if(strpos($_SERVER['REQUEST_URI'], 'announcements.php') !== false || strpos($_SERVER['REQUEST_URI'], 'announcementsContent.php') !== false) echo 'class="active"'; ?>>ANNOUNCEMENTS</a>
            <a href="contactUs.php" <?php if(strpos($_SERVER['REQUEST_URI'], 'contactUs.php') !== false) echo 'class="active"'; ?>>CONTACT US</a>
        </div>
        <div class="menu-icon">
            <i class="fas fa-bars"></i>
        </div>
        <div class="account">
    <a href='chat.php' style='text-decoration: none; color: inherit;'><i class='bx bxs-chat'></i></a>
    <?php
    if (!empty($row['img'])) {
        echo "<img src='images/" . $row['img'] . "' alt='profile' onclick='toggleDropdown(event)'>";
    } else {
        echo "<img src='images/defaultDP.png' alt='default profile' onclick='toggleDropdown(event)'>";
    }
    ?>
</div>

        <div class="dropdown-content" id="dropdownContent">
            <a href="editProfile.php" class="a1">
                <i class='bx bx-edit-alt'></i>
                <span> Update Profile</span>
            </a>
            <!-- <a href="#" class="a2">
                <i class="fa fa-cogs" aria-hidden="true"></i>
                <span>Settings</span>
            </a> -->
            <a href="logout.php" class="a3">
                <i class='bx bx-log-out-circle'></i>
                <span>Sign Out</span>
            </a>
        </div>
    </div>
</header>

<script>
    function toggleDropdown(event) {
    event.stopPropagation(); // Prevent body click event when the image is clicked
    const dropdown = document.getElementById("dropdownContent");

    if (dropdown.style.display === "none" || dropdown.style.display === "") {
        dropdown.style.display = "block";
        // Add event listeners to handle closing dropdown
        document.addEventListener('click', closeDropdownOutside);
        document.addEventListener('scroll', closeDropdownOnScroll);
    } else {
        dropdown.style.display = "none";
        removeEventListeners();
    }
}

function closeDropdownOutside(event) {
    const dropdown = document.getElementById("dropdownContent");
    const account = document.querySelector('.account img');  // Reference the profile image

    // Close dropdown only if clicked outside of the profile image and dropdown
    if (!dropdown.contains(event.target) && !account.contains(event.target)) {
        dropdown.style.display = "none";
        removeEventListeners();
    }
}

function closeDropdownOnScroll() {
    const dropdown = document.getElementById("dropdownContent");
    dropdown.style.display = "none";
    removeEventListeners();
}

function removeEventListeners() {
    document.removeEventListener('click', closeDropdownOutside);
    document.removeEventListener('scroll', closeDropdownOnScroll);
}

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let navbar = document.querySelector('.nav-links');
        let menuIcon = document.querySelector('.menu-icon');

        menuIcon.onclick = () => {
            navbar.classList.toggle('active');
        };
    });

</script>

<style>
.nav-container .menu-icon {
        display: none; /* Initially hide on larger screens */
        font-size: 30px;
        cursor: pointer;
}
@media only screen and (max-width: 768px) {
    .nav-container {
        padding: 0 10px;
        margin: 0;
    }
    .nav-container .nav-links{
        height: auto;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: none;
        padding: 15px;
        visibility: hidden;
        opacity: 0;
        flex-direction: column;
        position: absolute;
        top: 80px;
        right: 0;
        text-align: center;
        transition: visibility 0s, opacity 0.5s ease;
        z-index: 1000;
        margin: 0;
    }
    .nav-links.active {
        visibility: visible;
        opacity: 1;
        transition: opacity 0.5s ease;
        background-color: white;
        z-index: 1000;
    }
    .nav-links a {
        margin: 15px 0;
        color: white;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
    }
    .nav-links a.active {
        color: #3A8EF6;
        font-weight: 500;
    }
    .nav-container .menu-icon {
        display: block;
        cursor: pointer;
        margin-right: -150px;

    }
    .nav-container .logo {
        height: 95%;
        padding: auto 0;
    }
}

@media only screen and (max-width: 360px) {
    .nav-container .logo {
        height: 85%;
        padding: auto 0;
    }
    .nav-container {
        padding: 0;
    }
    .nav-container .menu-icon {
        margin-right: 0;
        margin-left: 75px;
    }
    .nav-container .account i {
        margin-right: 5px;
    }
}

.account img {
    width: 50px;
    height: 50px;
    display: block; /* Ensure it's not hidden */
    border-radius: 50%; /* Make it a circle */
}
.dropdown-content {
    display: none;
    position: absolute;
    background-color: white;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
}


</style>