<?php
include "dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - CareVisio</title>
    <link rel="stylesheet" href="style/signup_style.css">

    <link rel="shortcut icon" href="src/favicon.png" type="image/x-icon">

</head>
<body >
    <?php
      if(isset($_GET["error"])){
            
      };
    ?>
    <form method="post" action="log.php" enctype="multipart/form-data">
    <main id="s">
      <div id="main">
        <div id="left">
            <a href="index.php" id="logo-link" style="display: inline-block; width: 324px; height: 48px;">
              <img src="src/logo.png" id="logo">
            </a>
            <h1>Hello, Resident!</h1>
            <p style="color:gray;" class="subheading">Create your account</p>
            <p style="color:red;font-size:0.9rem; font-style: italic;"><?php if(isset($_GET["error"])){ echo $_GET["error"];}?></p>
               
            <input type="text" name="type" value="Resident" style="display: none;">

            <input type="text" required class="divs" placeholder="Firstname" name="fname" 
              value="<?php
              try{ if(isset($_GET["error"])){
                    echo $_GET["fname"];
                }
              }catch(Exception $e){}
            ?>">

            <input type="text"  class="divs"  placeholder="Middlename (optional)" name="mname"
              value="<?php
              try{ if(isset($_GET["error"])){
                    echo $_GET["mname"];
                }
            }catch(Exception $e){}
            ?>">

            <input type="text" required class="divs"  placeholder="Lastname" name="lname"
              value="<?php
              try{ if(isset($_GET["error"])){
                    echo $_GET["lname"];
                }
            }catch(Exception $e){}
            ?>">

            <input type="date" required  class="divs"  placeholder="Birthday" name="bday"
              value="<?php
              try{ if(isset($_GET["error"])){
                    echo $_GET["bday"];
                }
            }catch(Exception $e){}
            ?>">

            <input type="email" required  class="divs" style="<?php if(isset($_GET["exist"])){echo "box-shadow:0px 0px 2px red;";}?>"  placeholder="Email" name="email"
              value="<?php
              try{ if(isset($_GET["error"])){
                    echo $_GET["email"];
                }
            }catch(Exception $e){}
            ?>">

            <input type="password" required id="pass1"  class="divs sad"  placeholder="Password" name="password" style="<?php if(isset($_GET["password"])){echo "box-shadow:0px 0px 2px red;";}?>">
            <input type="password" style="<?php if(isset($_GET["password"])){echo "box-shadow:0px 0px 2px red;";}?>" required id="pass2" class="divs sad"  placeholder="Confirm Password" name="cpassword">
            
            <div class="checkBox">
              <input type="checkbox" id="show" onclick="myFunction()" class="check">
              <span class="showText">Show Password</span>
            </div>
            <!-- Added an image field here -->
            <div class="dp">
              <label for="image" class="labelImg">Profile Image:
              <input type="file" name="image" accept="image/*" required></label>
            </div>
            
            <button type="submit" name="submit" class="btn">Sign Up</button> <span class="loginLink">Already have an account?<a href="user/login.php" style="font-weight:600;"> Log in here</a></span>
                
        </div>
        <div id="right"></div>
      </div>
    </main>

  <script>
    function myFunction() {
      var x = document.getElementById("pass1");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
      var y = document.getElementById("pass2");
      if (y.type === "password") {
        y.type = "text";
      } else {
        y.type = "password";
      }
    }
  </script>

</form>
</body>
</html>