
<!-- Index.html file -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
          href="style.css">
    <title>ID QR Scanner / Reader
    </title>
    <style>
       
        /* style.css file*/
body {
  
    margin: 0;
    margin-top: 50px;
    padding: 10px;
    height: 100vh;
    /* background: rgb(128 0 0 / 66%); */
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


/* .container h1 {
    color: #ffffff;
} */

.section {
    background-color: #ffffff;
    padding: 50px 30px;
    border: 1.5px solid #b2b2b2;
    border-radius: 0.25em;
    box-shadow: 0 20px 25px rgba(0, 0, 0, 0.25);
}
/* .section2 {
    background-color: #ffffff;
    padding: 50px 30px;
    border: 1.5px solid #b2b2b2;
    border-radius: 0.25em;
    box-shadow: 0 20px 25px rgba(0, 0, 0, 0.25);
    width: 100%;
    height: 100vh;

} */

#my-qr-reader {
    padding: 20px !important;
    border: 1.5px solid #b2b2b2 !important;
    border-radius: 8px;
    width: 500px;
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
/* From Uiverse.io by dylanharriscameron */ 
.card {
  position: relative;
  width: 900px; /* Increased width */
  height: 250px;
  border-radius: 14px;
  z-index: 1111;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  box-shadow: 20px 20px 60px #bebebe, -20px -20px 60px #ffffff;
}

.bg {
  position: absolute;
  top: 5px;
  left: 5px;
  width: 880px; /* Updated width */
  height: 240px;
  z-index: 2;
  background: rgba(255, 255, 255, .95);
  backdrop-filter: blur(24px);
  border-radius: 10px;
  overflow: hidden;
  outline: 2px solid white;
}

.blob {
  position: absolute;
  z-index: 1;
  top: 50%;
  left: 50%;
  width: 550px; /* Adjusted size */
  height: 250px;
  border-radius: 50%;
  background-color: #428af5;
  opacity: 1;
  filter: blur(12px);
  animation: blob-bounce 5s infinite ease;
}


@keyframes blob-bounce {
  0% {
    transform: translate(-100%, -100%) translate3d(0, 0, 0);
  }

  25% {
    transform: translate(-100%, -100%) translate3d(100%, 0, 0);
  }

  50% {
    transform: translate(-100%, -100%) translate3d(100%, 100%, 0);
  }

  75% {
    transform: translate(-100%, -100%) translate3d(0, 100%, 0);
  }

  100% {
    transform: translate(-100%, -100%) translate3d(0, 0, 0);
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
        <!-- <div class="section2"> -->
            <div class="card">
            <div class="bg">
                <h1>Resident Details</h1>
            </div>
            <div class="blob"></div>
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
