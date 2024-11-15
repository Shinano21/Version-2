
<!-- Index.html file -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
          <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>ID QR Scanner / Reader
    </title>
    <style>
       
        /* style.css file*/
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    margin-top: 50px;
    padding: 25px;
    height: 100vh;
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
    background-color: #008000ad;
    transition: 0.3s background-color;
}

button:hover {
    background-color: #008000;
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

    </style>
</head>

<body>
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
            <img src="https://via.placeholder.com/150" alt="Resident Image" id="resident-image">
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
        <p><strong>Barangay:</strong> Estanza</p>
        <p><strong>Municipality:</strong> Cityville</p>
        <p><strong>Province:</strong> Province A</p>
        <p><strong>Zip Code:</strong> 12345</p>
        <p><strong>Contact:</strong> +63 912 345 6789</p>
        <p><strong>Educational Attainment:</strong> College Graduate</p>
        <p><strong>Occupation:</strong> Software Developer</p>
        <p><strong>Civil Status:</strong> Single</p>
        <p><strong>Labor Status:</strong> Employed</p>
        <p><strong>Voter Status:</strong> Registered Voter</p>
        <p><strong>PWD Status:</strong> No</p>
        <p><strong>4P's Member:</strong> No</p>
        <p><strong>Vaccination Status:</strong> Fully Vaccinated</p>
        <p><strong>Status:</strong> Active</p>
        <p><strong>Longitude:</strong> 123.4567</p>
        <p><strong>Latitude:</strong> -12.3456</p>
        <p><strong>ID Card No:</strong> 123-456-789</p>
    </div>

</div>


        <!-- </div> -->
    </div>

    <script
        src="https://unpkg.com/html5-qrcode">
    </script>
    <!-- <script src="script.js"></script> -->
</body>
<script>
    // script.js file

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

    // If found you qr code
    function onScanSuccess(decodeText, decodeResult) {
        alert("You Qr is : " + decodeText, decodeResult);
    }

    let htmlscanner = new Html5QrcodeScanner(
        "my-qr-reader",
        { fps: 10, qrbos: 250 }
    );
    htmlscanner.render(onScanSuccess);
});

</script>
</html>
