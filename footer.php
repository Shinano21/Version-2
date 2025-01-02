<style>
    /* Footer */
  footer {
    /* background-color: #212529; */
    background-color: #4D869C;
/* background-image: linear-gradient(90deg, #74EBD5 0%, #9FACE6 100%); */
    padding: 20px;
    position: relative;
    bottom: 0;
    width: 100%;
  }
  .footer-content {
    display: flex;
    justify-content: space-between;
    margin: 0 10% 0 10%;
    border-bottom: solid 2px rgba(255, 255, 255, 0.5);
  }
  .foot1 img{
    height: 100px;
    width: auto;
  }
  .foot1{
    text-align: center;
    width: 35%;
    margin-right: 5%;
  }
  .foot2 {
    width: 25%;
    display: flex;
    flex-direction: column;
    color: white;
  }

  .foot2 .links {
    display: flex;
    align-items: center;
    cursor: pointer;
  }
  .foot2 .links i,
  .foot2 .links p a{
    margin-right: 10px;
    font-size: 12px;
    color: white;
    text-decoration: none;
    cursor: pointer;
  }
  .foot2 .links i{
    color: #6cc0f4;
  }
  .foot2 .links:hover p{
    margin-left: 5px;
    transition: margin-left 0.3s ease;
  }

  .foot3 {
    width: 25%;
    display: flex;
    flex-direction: column;
    color: white;
  }
  .foot3 .links {
    display: flex;
    align-items: center;
    cursor: pointer;
  }
  .foot3 .links i,
  .foot3 .links p a{
    margin-right: 10px;
    font-size: 12px;
    cursor: pointer;
    color: white;
    text-decoration: none;
  }
  .foot3 .links i{
    color: #6cc0f4;
  }
  .foot3 .links:hover a{
    margin-left: 5px;
    transition: margin-left 0.3s ease;
  }

  @media only screen and (max-width: 768px) {
    .footer-content {
      flex-direction: column;
      align-items: center;
    }

    .foot1,
    .foot2,
    .foot3 {
      width: 100%;
      text-align: center;
    }
    .foot2 h4,
    .foot3 h4 {
        text-align: left;
    }
  }
</style>
<footer>
    <?php include "user/data/logo.php" ;
    // Assuming your logo data is stored in a variable called $navbarLogo
$logoFileName = $logoPic; // Adjust this to the variable that holds your logo filename
$logoPath = "admin/uploads/{$logoFileName}"; // Use the relative path to the logo
    ?>
    <div class="footer-content">
        <div class="foot1">
        <?php
            if (!empty($logoFileName)) {
                echo "<img src='{$logoPath}' alt='Logo' style='height: 100px; width: auto;' />";
            } else {
                echo "No image available";
            }
            ?>
            <h4 style="color: white;"><?php echo $centerName ?></h4>
            <p style="color: rgba(255, 255, 255, 0.5); font-size: small;">
                <?php echo $shortDesc ?>
            </p>
        </div>
        <div class="foot2">
            <h4 style="color: white;">Quick Links</h4>
            <div class="links">
                <i class="fas fa-arrow-right"></i>
                <p><a href="index.php" class="links">Home</a></p>
            </div>
            <div class="links">
                <i class="fas fa-arrow-right"></i>
                <p><a href="aboutUs.php" class="links">About</a></p>
            </div>
            <div class="links">
                <i class="fas fa-arrow-right"></i>
                <p><a href="programs.php" class="links">Programs</a></p>
            </div>
            <div class="links">
                <i class="fas fa-arrow-right"></i>
                <p><a href="contactUs.php" class="links">Contact Us</a></p>
            </div>
        </div>
        <div class="foot3">
            <h4 style="color: white;">Contact Info</h4>
            <div class="links">
                <i class="fa fa-phone"></i>
                <p><a href="tel:<?php echo str_replace([' ', '-', '(', ')'], '', $contact); ?>"><?php echo $contact; ?></a></p>
            </div>
            <div class="links">
                <i class="fas fa-envelope"></i>
                <p><a href="mailto:<?php echo $email; ?>"> <?php echo $email; ?></a></p>
            </div>
            <div class="links">
                <i class="fas fa-map-marker"></i>
                <p><a href="http://maps.google.com/?q=<?php echo $address; ?>" target="_blank"><?php echo $address; ?></a></p>
            </div>
        </div>
    </div>
    <p style="text-align: center; color: rgba(255, 255, 255, .3); margin: 25px 0px 5px; font-size: small;">&copy; 2024 |
        Techcare</p>
</footer>