
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
    padding: 15px;
    margin-left: 15px;
  box-sizing: border-box;
  width: 900px;
  height: auto;
  background: rgba(217, 217, 217, 0.58);
  border: 1px solid white;
  box-shadow: 12px 17px 51px rgba(0, 0, 0, 0.22);
  backdrop-filter: blur(6px);
  border-radius: 17px;
  text-align: center;
  cursor: pointer;
  transition: all 0.5s;
  display: flex;
  align-items: start;
  justify-content: start;
  user-select: none;
  font-weight: bolder;
  color: black;
}

.card:hover {
  border: 1px solid black;
  transform: scale(1.05);
}

.card:active {
  transform: scale(0.95) rotateZ(1.7deg);
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
            <h1>ID Scanner</h1>
            <div id="my-qr-reader">
            </div>
        </div>
  
            <div class="card">
                <h1 class="title">Resident Details</h1>
                <!-- <img src="https://via.placeholder.com/150" alt="Placeholder Image"> -->
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
