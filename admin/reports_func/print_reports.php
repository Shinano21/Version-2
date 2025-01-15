<!DOCTYPE html>
<?php
include '../dbcon.php';

$sql = "SELECT center_name FROM home LIMIT 1";
$result = $conn->query($sql);
$centerName = '';
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $centerName = $row['center_name'];
} else {
    $centerName = "No center name found";
}
?>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="../css/print.css">
    <link href="../css/lib/bootstrap.min.css" rel="stylesheet">
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <title>Print File</title>
</head>

<body>
    <?php
    $printContents = isset($_GET['content']) ? urldecode($_GET['content']) : '';
    $printLabel = isset($_GET['tableName']) ? urldecode($_GET['tableName']) : ''
    ?>

    <div class="printTemplate">
        <div class="header">
            <p>Print Preview</p>
            <div class="options">
                <button onclick="printContent('portrait')" class="btn btn-primary" id="print-portrait-btn">Print
                    Portrait</button>
                <button onclick="printContent('landscape')" class="btn btn-primary" id="print-landscape-btn">Print
                    Landscape</button>
                <button onclick="generatePDF()" class="btn btn-primary" id="pdf-btn">Generate PDF</button>
            </div>
        </div>
        <div class="contents" id="docContents">
            <div class="docuHeader">
                <!-- <div class="img"><img src="../src/techcareLogo2.png" alt="BrgyLogo"></div> -->
                 <div class="space"></div>
                <div class="mid">
                    <p class="text">Republic of the Philippines</p>
                    <p class="text">Province of Albay</p>
                    <p class="text">Municipality of Legazpi</p>
                    <p class="text" style="font-weight: 600;"><?php echo $centerName; ?></p>


                </div>
                <div class="space"></div>
            </div>
            <br>
            <div class="tableContents">
                <h5 style="color: black"><b><?php echo $printLabel; ?></b></h5>
                <br>
                <div class="tableContainer">
                    <table class="table table-bordered">
                        <?php echo $printContents; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
    const address = document.querySelector('.address-col');
    address.style.textAlign = "center";

    function printContent(mode) {
        var headerElement = document.querySelector('.header');

        if (headerElement) {
            headerElement.classList.add('hide-on-print');
            if (mode === 'landscape') {
                var style = document.createElement('style');
                style.innerHTML = `
                @media print {
                    @page {
                        size: landscape;
                    }
                    /* Additional styles to fit content within the page */
                    body {
                        width: 100%;
                    }
                    table {
                        width: 100%;
                        /* Adjust other table styles if needed */
                    }
                    /* Add similar adjustments for other elements as needed */
                }
            `;
                document.head.appendChild(style);
            } else {
                var style = document.querySelector('style');
                if (style) {
                    style.remove();
                }
            }

            window.print();

            headerElement.classList.remove('hide-on-print'); // Show the header after printing
        } else {
            console.error('Header element not found');
        }
    }

    function getDate() {
        var today = new Date();
        var month = today.getMonth() + 1;
        var day = today.getDate();
        var year = today.getFullYear().toString().substr(-2);
        var formattedDate = `${month}-${day}-${year}`;
        console.log(formattedDate);
        return formattedDate;
    }

    function generatePDF() {
        // Get the HTML content to be converted
        var content = document.getElementById('docContents');
        var now = getDate();
        // Configure the PDF options
        var options = {
            margin: 10,
            filename: `<?php echo $printLabel; ?> (${now})`,
            image: {
                type: 'jpeg',
                quality: 1
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait'
            }
        };

        // Use html2pdf to generate PDF
        html2pdf(content, options);
    }
    </script>
</body>

</html>