<div class="header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <!-- Fix hamburger alignment -->
                        <div class="hamburger sidebar-toggle d-flex align-items-center" style="margin-right: 10px;">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                        <div id="ccc" class="d-flex align-items-center" style="margin-left: 20px;">
                            <img src="src/brgy.png" style="height:50px;">
                            <div style="margin-left: 10px;">
                                <b>Brgy. Bagumbayan Health Center</b>
                                <span id="ct" style="display: block; font-size: 12px; color: gray;">Mon, Sep 30, 2024 - 09:01:01 PM</span>
                            </div>
                        </div>
                    </div>
                    <div class="user-info">
                        <?php
                            if(isset($_SESSION["user_type"]) && $_SESSION["user_type"] !== "System Administrator") {
                                echo "<div class='dropdown dib'>
                                        <div class='header-icon' data-toggle='dropdown'>
                                            <a href='chat.php' style='text-decoration: none; color: inherit;font-size:28px;'><i class='ti-comments'></i></a>
                                        </div>
                                      </div>";
                            }
                        ?>
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <span class="user-avatar">
                                    <b><?php echo $_SESSION["firstname"] . " " . $_SESSION["midname"] . " " . $_SESSION["lastname"]; ?></b>
                                    <i class="ti-angle-down f-s-10"></i>
                                    <span style="color: gray; cursor:text; display:block">
                                        <?php echo $_SESSION["user_type"]; ?>
                                    </span>
                                </span>
                                <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="edit_admin_profile.php">
                                                    <i class="ti-user"></i>
                                                    <span>Edit Profile</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="logout.php">
                                                    <i class="ti-power-off"></i>
                                                    <span>Logout</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
   /* Adjust hamburger menu alignment */
.hamburger {
    display: flex;
    align-items: center;
    height: 50px; /* Same as logo height */
    cursor: pointer;
}

.hamburger .line {
    width: 25px;
    height: 2px;
    background-color: #333;
    margin: 5px 0;
}

/* Align logo and text */
#ccc img {
    vertical-align: middle;
}

#ccc b {
    font-size: 16px;
    margin-left: 10px;
}

/* Align text and user section */
.user-avatar b {
    font-size: 16px;
    margin-right: 5px;
}

</style>