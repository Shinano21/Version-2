<?php include "../dbcon.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print as PDF</title>
    <!-- Include html2pdf.js library -->
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
</head>
<body>
    <!-- Your HTML content to be converted to PDF -->
    <div id="content">
    
    <table class="table_">
		<tbody class="calibre1"><tr class="calibre2">
			<td colspan="6" class="td_"><p class="block_">Newborn (0-28 days old)</p><p class="block_">(10)</p></td>
			<td colspan="8" class="td_1"><p class="block_">1-3 months old</p><p class="block_">(11)</p></td>
		</tr>
		<tr class="calibre2">
			<td rowspan="2" class="td_2"><p class="block_">Length <br class="calibre3" />at Birth</p><p class="block_">(cm)</p></td>
			<td rowspan="2" class="td_3"><p class="block_">Weight at</p><p class="block_">Birth</p><p class="block_">(kg)</p></td>
			<td class="td_4"><p class="block_">Status</p><p class="block_">(Birth Weight)</p></td>
			<td rowspan="2" class="td_5"><p class="block_">Iniated Breast feeding</p><p class="block_">Immediately</p><p class="block_">After birth lasting for 90 minutes</p><p class="block_">(date)</p></td>
			<td colspan="2" class="td_6"><p class="block_">Immunization</p></td>
			<td colspan="4" class="td_7"><p class="block_">Nutritional Status Assessment</p></td>
			<td colspan="3" class="td_8"><p class="block_">Low Birth Given Iron</p><p class="block_">(Write at Date)</p></td>
		</tr>
		<tr class="calibre2">
			<td class="td_4"><p class="block_"><b class="calibre4">L</b>: low : &lt;2,500 gms</p><p class="block_"><b class="calibre4">N</b><span class="calibre5">: normal:  &gt;2,500 </span>gms</p><p class="block_"><b class="calibre4">U</b>: unknown</p></td>
			<td class="td_9"><p class="block_">BCG</p><p class="block_">(Date)</p></td>
			<td class="td_10"><p class="block_">Hepa B-BD</p><p class="block_">(Date)</p><p class="block_1">&nbsp;</p></td>
			<td class="td_11"><p class="block_">Age in months</p></td>
			<td class="td_12"><p class="block_">Length</p><p class="block_">(cm)</p><p class="block_">&amp; </p><p class="block_">Date Taken</p></td>
			<td class="td_13"><p class="block_">Weight</p><p class="block_">(kg)</p><p class="block_">&amp; </p><p class="block_">Date Taken</p></td>
			<td class="td_14"><p class="block_">Status</p><p class="block_"><b class="calibre4">S</b>: stunted</p><p class="block_"><b class="calibre4">W-MAM</b>: wasted-MAM</p><p class="block_"><b class="calibre4">W-SAM</b>: wasted-SAM</p><p class="block_"><b class="calibre4">O</b>: Obese/overweight</p><p class="block_"><b class="calibre4">N:</b> normal</p></td>
			<td class="td_15"><p class="block_">1mo</p></td>
			<td class="td_16"><p class="block_">2mos</p></td>
			<td class="td_17"><p class="block_">3mos</p></td>
		</tr>
        <?php
                $sql = "SELECT * FROM immunization_2 ";
                $i = 1;
$result = mysqli_query($conn, $sql);
$even = 0;
// Check if there are results
if (mysqli_num_rows($result) > 0) {
   
    while ($row = mysqli_fetch_assoc($result)) {
      //  $orderdate = explode('-', $row["reg"]);

      /*
	<tr class="calibre2">
			<td rowspan="2" class="td_2"><p class="block_1">&nbsp;</p></td>
			<td rowspan="2" class="td_3"><p class="block_1">&nbsp;</p></td>
			<td rowspan="2" class="td_4"><p class="block_1">&nbsp;</p></td>
			<td rowspan="2" class="td_5"><p class="block_1">&nbsp;</p></td>
			<td rowspan="2" class="td_9"><p class="block_1">&nbsp;</p></td>
			<td rowspan="2" class="td_10"><p class="block_1">&nbsp;</p></td>
			<td rowspan="2" class="td_11"><p class="block_1">&nbsp;</p></td>
			<td class="td_12"><p class="block_1">&nbsp;</p></td>
			<td class="td_13"><p class="block_1">&nbsp;</p></td>
			<td rowspan="2" class="td_14"><p class="block_1">&nbsp;</p></td>
			<td rowspan="2" class="td_15"><p class="block_1">&nbsp;</p></td>
			<td rowspan="2" class="td_16"><p class="block_1">&nbsp;</p></td>
			<td rowspan="2" class="td_17"><p class="block_1">&nbsp;</p></td>
		</tr>
		<tr class="calibre2">
			<td class="td_18"><p class="block_1">&nbsp;</p></td>
			<td class="td_19"><p class="block_1">&nbsp;</p></td>
		</tr>
      */
		echo '<td rowspan="2" class="td_2"> '.$row["length_at_birth"].'</td>
			<td rowspan="2" class="td_3"> '.$row["weight_at_birth"].'</td>
            <td rowspan="2" class="td_2"> '.$row["birth_weight_status"].' </td>
			<td rowspan="2" class="td_3"> '.$row["breastfeeding_initiation_date"].'</td>
            <td rowspan="2" class="td_2"> '.$row["bcg_date"].'</td>
			<td rowspan="2" class="td_3"> '.$row["hepa_b_bd_date"].'</td>
            <td rowspan="2" class="td_2"> '.$row["age_in_months_1"].'</p></td>
			
            
			';
			echo '<td class="td_12"><p class="block_1">'.$row["length_cm_1"].' </p></td>
			<td class="td_13"><p class="block_1">'.$row["weight_kg_1"].'</p></td>
			<td rowspan="2" class="td_14"><p class="block_1">'.$row["sst_1"].'</p></td>
			<td rowspan="2" class="td_15"><p class="block_1">'.$row["lbw_given_iron_1"].'</p></td>
			<td rowspan="2" class="td_16"><p class="block_1">'.$row["lbw_given_iron_2"].'</p></td>
			<td rowspan="2" class="td_17"><p class="block_1">'.$row["lbw_given_iron_3"].'</p></td>
		</tr>
		<tr class="calibre2">
			<td class="td_18"><p class="block_1">&nbdsp;</p></td>
			<td class="td_19"><p class="block_1">&nbdsp;</p></td>
		</tr>';
       
    }
}
        ?>
	</tbody></table>
</div>
    <style>
        table{
            width:100%;
            text-align:center;
            
        }
        table,th,tr,td{
            border:1px solid black;
            border-collapse:collapse;
        }
        </style>

    <!-- Button to trigger PDF generation -->
    <button onclick="generatePDF()">Generate PDF</button>

    <script>
        function generatePDF() {
            // Get the HTML content to be converted
            var content = document.getElementById('content');

            // Configure the PDF options
            var options = {
                margin: 10,
                filename: 'output.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
            };

            // Use html2pdf to generate PDF
            html2pdf(content, options);
        }
    </script>
</body>
</html>
