<div class="header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                        <div id="ccc" style="display: flex; align-items: center; margin-left: 20px;">
                            <img src="src/brgy.png" style="height:50px;">
                            <div style="margin-left: 10px;">
                                <b>Brgy. Bagumbayan Health Center</b>
                                <span id="ct" style="display: block; font-size: 12px;">Date/Time here</span>
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
                                    <span style="color: gray;cursor:text;display:block">
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
