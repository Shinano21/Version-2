<?php 
    $notfound = false;
    include 'config.php';
    $html = '';

    if (isset($_POST['search'])) {
        $id_card_no = $_POST['id_no'];

        // Fetch data from the 'residents' table
        $sql = "SELECT * FROM `residents` WHERE `id_card_no` = '$id_card_no'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $html = "<div class='card' style='width:350px; padding:0;'>";

            while ($row = mysqli_fetch_assoc($result)) {
                // Resident details
                $fname = $row["fname"];
                $mname = $row["mname"];
                $lname = $row["lname"];
                $suffix = $row["suffix"];
                $full_name = $fname . ' ' . $mname . ' ' . $lname . ' ' . $suffix;
                $id_card_no = $row["id_card_no"];
                $contact = $row['contact'];
                $bday = $row['bday'];
                $zone = $row['zone'];
                $sex = $row['sex'];
                $address = $row['street'] . ', ' . $row['brgy'] . ', ' . $row['mun'] . ', ' . $row['province'];
                $profile = '../residents_img/' . $row['profile']; // Correct relative path from id-card.php
                $exp_date = $row['exp_date'] ?? 'N/A';
                // $qr_code_path = '../qrcodes/' . $row['qr_code']; // Correct relative path for QR code
                $qr_code_path = '../qrcodes/' . $row['qr_code']; // This resolves to 'qrcodes/123_qrcode.png'

                // Card HTML
                $html .= "
                <!-- Flippable ID Card -->
                <div class='card'>
                    <div class='card-inner'>
                        <!-- Front Side -->
                        <div class='card-front' id='card-front'>
                            <!-- Full ID Card Content -->
                            <div class='container' style='text-align:left; border:2px dotted black;'>
                                <div class='header'></div>
            
                                <div class='container-2'>
                                    <div class='box-1'>
                                        <img src='$profile' alt='Profile Image'/>
                                    </div>
                                    <div class='box-2'>
                                        <h2>$full_name</h2>
                                        <p style='font-size: 14px;'>Resident</p>
                                    </div>
                                    <div class='box-3'>
                                        <img src='assets/images/logo.svg' alt='Logo' style='width: 90px; height: 90px;'/>
                                    </div>
                                </div>
            
                                <div class='container-3'>
                                    <div class='info-1'>
                                        <div class='id'>
                                            <h4>ID No</h4>
                                            <p>$id_card_no</p>
                                        </div>
            
                                        <div class='dob'>
                                            <h4>Birthday</h4>
                                            <p>$bday</p>
                                        </div>
                                    </div>
                                    <div class='info-2'>
                                        <div class='join-date'>
                                            <h4>Sex</h4>
                                            <p>$sex</p>
                                        </div>
                                        <div class='expire-date'>
                                            <h4>Zone</h4>
                                            <p>$zone</p>
                                        </div>
                                    </div>
                                    <div class='info-3'>
                                        <div class='email'>
                                            <h4>Address</h4>
                                            <p>$address</p>
                                        </div>
                                    </div>
                                    <div class='info-4'>
                                        <div class='qr-code' style='text-align:center;'>
                                            <img src='$qr_code_path' alt='QR Code' style='width:100px; height:100px;'/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <!-- Back Side -->
                     <div class='card-back' id='card-back'>
    <div class='back-content' style='padding: 20px; text-align: center; '>
        <h3>Terms and Conditions</h3>
        <p><strong>1. Proof of Identity:</strong> This ID card is issued by Barangay of $address and serves as proof of residency for the holder. It is not a substitute for government-issued identification.</p>
        <p><strong>2. Non-Transferable:</strong> This ID card is strictly personal and cannot be used by anyone other than the authorized holder.</p>
        <p><strong>3. Purpose:</strong> The card is intended for barangay-related transactions, community services, and emergency identification. It should not be used for commercial or unlawful purposes.</p>
        <p><strong>4. Loss or Damage:</strong> Report lost, stolen, or damaged cards to the Barangay Office immediately. Replacement fees may apply.</p>
       
    </div>
</div>

                    </div>
                </div>
            ";
            
            }
            
        } else {
            $html = "<p>No records found for ID No: $id_card_no</p>";
        }
    }
?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="../images/techcareLogo2.png" type="image/x-icon">
<link rel="stylesheet" href="CSS/styles.css">
    <title>Card Generation | TechCare</title>
       <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.js"></script>
  </head>
  <body>

  <br>
  <a href="index.php" id="backToHome">
    <h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i> Back to previous page</h7>
 </a>
 <br>
<div class="row" style="margin: 50px 20px 5px 20px">
<div class="col-sm-6 mx-auto mt-5">
  <div class="card shadow-sm">
    <div class="card-header text-white text-center" style="background-color: #4D869C;">
      <h5 >Resident ID Card Generator</h5>
    </div>
    <div class="card-body bg-light">
      <form class="form" method="POST" action="id-card.php">
        <div class="mb-3">
          <label for="id_no" class="form-label font-weight-bold">Resident ID Card No.</label>
          <input 
            class="form-control" 
            type="search" 
            placeholder="Enter ID Card No." 
            name="id_no" 
            id="id_no" 
            required>
          <small id="emailHelp" class="form-text text-muted">
            Every resident should have a unique ID number.
          </small>
        </div>
        <div class="d-flex justify-content-center" >
          <button 
            class="btn btn-primary" 
            type="submit" 
            name="search"
            style="background-color: #4D869C;"
            >
            Generate
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

  <div class="col-sm-6">
      <div class="cards">
          <div class="card-header" style="display: flex; justify-content:center; font-weight: bold;" >
              Here is your Id Card
          </div>
        <div class="card-body" id="mycard">
          <?php echo $html ?>
        </div>
        <br>
        
     </div>
     <div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle" style="background-color: #4D869C;" data-bs-toggle="dropdown" aria-expanded="false">
    Download Image ID
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#" onclick="downloadFrontCard()">Download Front</a></li>
    <li><a class="dropdown-item" href="#" onclick="downloadBackCard()">Download Back</a></li>
  </ul>
</div>

<div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle" style="background-color: #4D869C;" data-bs-toggle="dropdown" aria-expanded="false">
    Print ID
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#" onclick="printFrontCard()">Print Front</a></li>
    <li><a class="dropdown-item" href="#" onclick="printBackCard()">Print Back</a></li>
    <li><a class="dropdown-item" href="#" onclick="printCombinedCard()">Print Combined</a></li>
  </ul>
</div>

  </div>
  </div>
<hr>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script>
function downloadFrontCard() {
    var node = document.getElementById('card-front');

    // Capture the front side only
    domtoimage.toPng(node)
        .then(function (dataUrl) {
            downloadURI(dataUrl, "resident-id-card-front.png");
        })
        .catch(function (error) {
            console.error('Oops, something went wrong', error);
        });
}

function downloadURI(uri, name) {
    var link = document.createElement("a");
    link.download = name;
    link.href = uri;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>

<script>
function downloadBackCard() {
    var node = document.getElementById('card-back');

    // Temporarily fix inversion for capturing
    node.style.transform = 'none';

    domtoimage.toPng(node)
        .then(function (dataUrl) {
            downloadURI(dataUrl, "resident-id-card-back.png");
            // Restore the original transform after capturing
            node.style.transform = '';
        })
        .catch(function (error) {
            console.error('Oops, something went wrong', error);
            node.style.transform = ''; // Restore on error
        });
}

function downloadURI(uri, name) {
    var link = document.createElement("a");
    link.download = name;
    link.href = uri;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>

<script>
function downloadImage(elementId, callback) {
    var node = document.getElementById(elementId);

    domtoimage.toPng(node)
        .then(function (dataUrl) {
            callback(dataUrl);
        })
        .catch(function (error) {
            console.error('Oops, something went wrong', error);
        });
}

function printImage(dataUrl) {
    var printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Print ID Card</title></head><body>');
    printWindow.document.write('<img src="' + dataUrl + '" />');
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}

function printFrontCard() {
    downloadImage('card-front', printImage);
}

function printBackCard() {
    downloadImage('card-back', printImage);
}

</script>

<!-- <script>
function downloadImage(elementId, callback) {
    var node = document.getElementById(elementId);

    // Temporarily fix inversion for the back side
    if (elementId === 'card-back') {
        node.style.transform = 'none';
    }

    domtoimage.toPng(node)
        .then(function (dataUrl) {
            callback(dataUrl);
            // Restore the original transform after capturing
            if (elementId === 'card-back') {
                node.style.transform = '';
            }
        })
        .catch(function (error) {
            console.error('Oops, something went wrong', error);
            // Restore the original transform on error
            if (elementId === 'card-back') {
                node.style.transform = '';
            }
        });
}

function printCombinedCard() {
    var frontDataUrl, backDataUrl;

    downloadImage('card-front', function(dataUrl) {
        frontDataUrl = dataUrl;
        checkAndPrint();
    });

    downloadImage('card-back', function(dataUrl) {
        backDataUrl = dataUrl;
        checkAndPrint();
    });

    function checkAndPrint() {
        if (frontDataUrl && backDataUrl) {
            var printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Print ID Card</title></head><body>');
            printWindow.document.write('<div><img src="' + frontDataUrl + '" /></div>');
            printWindow.document.write('<div><img src="' + backDataUrl + '" /></div>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    }
}
</script> -->
<script>
function downloadImage(elementId, callback) {
    var node = document.getElementById(elementId);

    // Temporarily fix inversion for the back side
    if (elementId === 'card-back') {
        node.style.transform = 'none';
    }

    domtoimage.toPng(node)
        .then(function (dataUrl) {
            callback(dataUrl);
            // Restore the original transform after capturing
            if (elementId === 'card-back') {
                node.style.transform = '';
            }
        })
        .catch(function (error) {
            console.error('Oops, something went wrong', error);
            // Restore the original transform on error
            if (elementId === 'card-back') {
                node.style.transform = '';
            }
        });
}

function printImage(dataUrl, width, height) {
    var printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Print ID Card</title></head><body>');
    printWindow.document.write('<div><img src="' + dataUrl + '" style="width:' + width + 'px; height:' + height + 'px;" /></div>');
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}

function printFrontCard() {
    downloadImage('card-front', function(dataUrl) {
        printImage(dataUrl, 336, 212); // Approx. 3.375 inches by 2.125 inches in pixels (assuming 96 DPI)
    });
}

function printBackCard() {
    downloadImage('card-back', function(dataUrl) {
        printImage(dataUrl, 336, 212); // Approx. 3.375 inches by 2.125 inches in pixels (assuming 96 DPI)
    });
}

function printCombinedCard() {
    var frontDataUrl, backDataUrl;

    downloadImage('card-front', function(dataUrl) {
        frontDataUrl = dataUrl;
        checkAndPrint();
    });

    downloadImage('card-back', function(dataUrl) {
        backDataUrl = dataUrl;
        checkAndPrint();
    });

    function checkAndPrint() {
        if (frontDataUrl && backDataUrl) {
            var printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Print ID Card</title></head><body>');
            printWindow.document.write('<div><img src="' + frontDataUrl + '" style="width:336px; height:212px;" /></div>'); // Front side
            printWindow.document.write('<div><img src="' + backDataUrl + '" style="width:336px; height:212px;" /></div>'); // Back side
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    }
}
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>