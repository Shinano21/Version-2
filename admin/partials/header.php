
<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="float-left">
                    <div class="hamburger sidebar-toggle">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                    <div id="ccc"
                        style="position:relative;margin:1%;height:50px;position:absolute;top:0;left:5%;width:100%;">
                        <img src="../src/brgy.png" style="height:50px;">
                        <b><span style="margin-left: 3px;margin-top: 8px;position: absolute;">Brgy. Bagumbayan Health
                                Center</span></b><br>
                        <span id="ct" style="margin-left: 67px;margin-top: -23px;position: absolute;"></span>
                    </div>

                </div>
                <div class="float-right">
                <div class="dropdown dib">
    <div class="header-icon" data-toggle="dropdown">
        <a href='./chat.php' onclick='redirectToHead(event)' style='text-decoration: none; color: inherit; font-size: 30px;' title="Chats">
            <i class="ti-comments"></i>
        </a>
    </div>
</div>
<script>
    function redirectToHead(event) {
        event.preventDefault(); // Prevent default anchor behavior
        window.location.href = './chat.php'; // Correct path to chat.php
    }
</script>

                    <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <span class="user-avatar">
                                    <b2><?php echo $_SESSION["firstname"] . " " .$_SESSION["midname"]. " " . $_SESSION["lastname"] ?></b2>
                                    <i class="ti-angle-down f-s-10"></i>
                                    <b2 style="color: gray;cursor:text;display:block">
                                    <?php echo $_SESSION["user_type"] ?>
                                </b2>
                                </span>
                                <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right">

                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="./edit_admin_profile.php" onclick=" window.location.href='./edit_admin_profile.php';">
                                                    <i class="ti-user"></i>
                                                    <span>Edit Profile</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="../logout.php" onclick=" window.location.href='../logout.php';">
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
