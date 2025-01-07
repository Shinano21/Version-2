
<!-- Index.html file -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
          <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="../images/techcareLogo2.png" type="image/x-icon">


    <title>ID QR Scanner | TechCare
    </title>
    <style>
       
        /* style.css file*/
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    margin-top: 50px;
    padding: 25px;
    height: 100vh;
    background-color: #CDE8E5;
    /* background: rgb(128 0 0 / 66%); */
}
h1 {
     font-weight: 400; /* Adjust the weight as needed */ 
     font-size: 26px;
    }
.container {
    text-align: center;
    display: flex;
    justify-content: start;
    width: 100%;
    /* max-width: 500px; */
    margin: 5px;
    box-sizing: border-box;

}

.section {
    background-color: #ffffff;
    padding: 50px 30px;
    border: 1.5px solid #b2b2b2;
    border-radius: 0.25em;
    box-shadow: 0 20px 25px rgba(0, 0, 0, 0.25);
}

#my-qr-reader {
    padding: 20px !important;
    border: 1.5px solid #b2b2b2 !important;
    border-radius: 8px;
    width: 390px;
}

#my-qr-reader img[alt="Info icon"] {
    display: none;
}

#my-qr-reader img[alt="Camera based scan"] {
    width: 100px !important;
    height: 100px !important;
}

button {
    padding: 10px 20px;
    border: 1px solid #b2b2b2;
    outline: none;
    border-radius: 0.25em;
    color: white;
    font-size: 15px;
    cursor: pointer;
    margin-top: 15px;
    margin-bottom: 10px;
    background-color: #4D869C;
    transition: 0.3s background-color;
}

button:hover {
    background-color: blue;
}

#html5-qrcode-anchor-scan-type-change {
    text-decoration: none !important;
    color: #1d9bf0;
}

video {
    width: 100% !important;
    border: 1px solid #b2b2b2 !important;
    border-radius: 0.25em;
}
/* From Uiverse.io by adamgiebl */ 
/* From Uiverse.io by SteveBloX */ 
.card {
    padding: 20px;
    margin: 20px auto;
    max-width: 800px;
    width: 100%;
    background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
    border: 1px solid #b2b2b2;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    border-radius: 15px;
    text-align: left;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    gap: 20px;
    position: relative;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
}

.card:active {
    transform: translateY(0);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
}

.title {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}
.additional-info {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    text-align: left;
    margin-top: 15px;
}

.additional-info p {
    margin: 5px 0;
    font-size: 14px;
    color: #333;
}


.details-row {
    display: flex;
    align-items: center;
    justify-content: start;
    gap: 20px;
}

.image-placeholder {
    width: 150px;
    height: 150px;
    background-color: #e0e0e0;
    border: 1px solid #b2b2b2;
    border-radius: 8px;
    overflow: hidden;
}

#resident-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.resident-info {
    flex: 1;
}

.resident-info p {
    margin: 5px 0;
    font-size: 16px;
    color: #555;
}


/* Media queries for responsiveness */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
        align-items: center;
    }

    .section,
    .card {
        max-width: 90%;
    }
}

@media (max-width: 480px) {
    h1 {
        font-size: 20px;
    }

    button {
        font-size: 14px;
        padding: 8px 16px;
    }

    .card {
        height: 220px;
    }
}
#backToHome {
    position: absolute;
    top: 20px;
    left: 10%;
    transform: translateX(-50%);
    color: #646665;
    text-decoration: none;

}
#backToHome:hover { text-decoration: underline; }
#header-row{
display: flex;
align-items: center;
justify-content: space-between;
}
a:hover {
    color: black;
  }
    </style>
</head>

<body>
<a href="../home.php" id="backToHome">
    <h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i> Back to Home</h7>
 </a>

 <div class="row align-items-center py-3 px-5 mt-5" id="header-row">
    <!-- Left Section -->
    <div class="col-md-6 d-flex align-items-center justify-content-start" style="padding-left: 50px;">
        <h1 class="mb-0" style="font-weight:500; font-size: 1.8rem; color: #333;">ID System</h1>
    </div>

    <!-- Right Section -->
    <div class="col-md-6 d-flex justify-content-end align-items-center" style="padding-right: 50px;">
        <nav>
            <ol class="breadcrumb mb-0" style="background: none; margin: 0; padding: 0; list-style: none;">
                <li class="breadcrumb-item" style="display: inline;">
                    <a href="../home.php" style="color: #333; text-decoration: none;">Dashboard </a>
                </li>
                <li class="breadcrumb-item active" style="display: inline; margin-left: 10px; color: #6c757d;">
                    / Scan ID
                </li>
            </ol>
        </nav>
    </div>
</div>

    <div class="container">
        <div class="section">
            <h1 class="title">ID Scanner</h1>
            <div id="my-qr-reader">
            </div>
        </div>
  
        <div class="card">
    <h1 class="title">Resident Details</h1>
    <div class="details-row">
        <div class="image-placeholder">
            <img src="../residents_img/user.png" alt="Resident Image" id="resident-image">
        </div>
        <div class="resident-info">
            <p><strong>Name:</strong> John Doe</p>
            <p><strong>Age:</strong> 30</p>
            <p><strong>Address:</strong> 123 Main St, Cityville</p>
        </div>
    </div>
    <hr style="border: 1px solid #555; width: 100%;">

     <!-- Additional Resident Details -->
     <div class="additional-info">
        <p><strong>Sex:</strong> Male</p>
        <p><strong>Birthday:</strong> January 1, 1990</p>
        <p><strong>Place of Birth:</strong> Cityville Hospital</p>
        <p><strong>Religion:</strong> Christianity</p>
        <p><strong>Citizenship:</strong> Filipino</p>
        <p><strong>Street:</strong> Elm Street</p>
        <p><strong>Zone:</strong> 5</p>
        <p><strong>Province:</strong> Province A</p>
        <p><strong>Zip Code:</strong> 12345</p>
        <p><strong>Contact:</strong> +63 912 345 6789</p>
        <p><strong>Educational Attainment:</strong> College Graduate</p>
        <p><strong>Occupation:</strong> Software Developer</p>
        <p><strong>Civil Status:</strong> Single</p>
        <p><strong>Labor Status:</strong> Employed</p>
        <p><strong>Voter Status:</strong> Registered Voter</p>
        <p><strong>PWD Status:</strong> No</p>
        <p><strong>Vaccination Status:</strong> Fully Vaccinated</p>
        <p><strong>Status:</strong> Active</p>
        <p><strong>Longitude:</strong> 123.4567</p>
        <p><strong>Latitude:</strong> -12.3456</p>
    </div>

</div>


        <!-- </div> -->
    </div>

    <script src="html5-qrcode/minified/html5-qrcode.min.js"></script>
    <!-- <script src="script.js"></script> -->
</body>
<script>
  // Ensure the script runs when the DOM is fully loaded
  function domReady(fn) {
    if (
      document.readyState === "complete" ||
      document.readyState === "interactive"
    ) {
      setTimeout(fn, 1000);
    } else {
      document.addEventListener("DOMContentLoaded", fn);
    }
  }

  domReady(function () {
    // Initialize the QR code scanner with optimized FPS
    const htmlscanner = new Html5QrcodeScanner("my-qr-reader", {
  fps: 60, // Higher frames per second for faster scanning
  qrbox: { width: 200, height: 200 }, // Narrow the scan box for optimized performance
  experimentalFeatures: {
    useBarCodeDetectorIfSupported: true, // Enable experimental barcode detection for speed
  },
  rememberLastUsedCamera: true, // Remembers the last selected camera for faster setup
});


    htmlscanner.render(onScanSuccess);
    console.log("QR scanner initialized.");

    // Debounce timer to prevent multiple rapid scans
    let debounceTimer = null;

    // Define the callback function for successful scan
    function onScanSuccess(decodedText) {
      console.log("Scanned ID Card Number:", decodedText);

      // Debounce the handler to prevent multiple calls
      if (debounceTimer) clearTimeout(debounceTimer);

      debounceTimer = setTimeout(() => {
        fetchResidentData(decodedText);
      }, 300); // 300ms debounce delay
    }

    // Function to fetch resident data from the server
    function fetchResidentData(idCardNo) {
      fetch("fetch_resident.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ id_card_no: idCardNo }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            // Update the card container with resident details
            document.getElementById("resident-image").src = data.profile
              ? "/Version-2/admin/" + data.profile
              : "https://via.placeholder.com/150";
            document.querySelector(".resident-info").innerHTML = `
                        <p><strong>Name:</strong> ${data.fname} ${data.mname} ${data.lname}</p>
                        <p><strong>Age:</strong> ${data.age}</p>
                        <p><strong>Address:</strong> ${data.street}, ${data.brgy}, ${data.mun}</p>
                    `;
            document.querySelector(".additional-info").innerHTML = `
                        <p><strong>Sex:</strong> ${data.sex}</p>
                        <p><strong>Birthday:</strong> ${data.bday}</p>
                        <p><strong>Place of Birth:</strong> ${data.pob}</p>
                        <p><strong>Religion:</strong> ${data.religion}</p>
                        <p><strong>Citizenship:</strong> ${data.citizenship}</p>
                        <p><strong>Zip Code:</strong> ${data.zipcode}</p>
                        <p><strong>Contact:</strong> ${data.contact}</p>
                        <p><strong>Educational Attainment:</strong> ${data.educational}</p>
                        <p><strong>Occupation:</strong> ${data.occupation}</p>
                        <p><strong>Civil Status:</strong> ${data.civil_status}</p>
                        <p><strong>Labor Status:</strong> ${data.labor_status}</p>
                        <p><strong>Voter Status:</strong> ${data.voter_status}</p>
                        <p><strong>PWD Status:</strong> ${data.pwd_status}</p>
                        <p><strong>4P's Member:</strong> ${data.four_p}</p>
                        <p><strong>Vaccination Status:</strong> ${data.vac_status}</p>
                        <p><strong>Status:</strong> ${data.status}</p>
                        <p><strong>Longitude:</strong> ${data.longitude}</p>
                        <p><strong>Latitude:</strong> ${data.latitude}</p>
                    `;
          } else {
            alert("Resident not found!");
          }
        })
        .catch((error) => {
          console.error("Error fetching resident data:", error);
          alert("An error occurred while fetching resident data.");
        });
    }
  });
</script>

</html>
