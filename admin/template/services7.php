<?php 
include '../dbcon.php'; // Include database connection

// Initialize prenatal statistics
$prenatalStats = [
    '4_checkups' => 0,
    'calcium_supplementation' => 0,
    'iodine_capsules' => 0,
    'deworming_tablets' => 0,
    'syphilis_screened' => 0,
    'syphilis_positive' => 0,
    'hepB_screened' => 0,
    'hepB_positive' => 0,
    'hiv_screened' => 0,
    'cbc_tested' => 0,
    'cbc_anemia' => 0,
    'gestational_diabetes_screened' => 0,
    'gestational_diabetes_positive' => 0,
];

// Query for prenatal statistics
$result = $conn->query("SELECT * FROM prenatal");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        if (!empty($row['calcium_supplementation'])) $prenatalStats['calcium_supplementation']++;
        if (!empty($row['iodine_capsules'])) $prenatalStats['iodine_capsules']++;
        if (!empty($row['deworming_tablets'])) $prenatalStats['deworming_tablets']++;
        if (!empty($row['syphilis_screened'])) $prenatalStats['syphilis_screened']++;
        if (!empty($row['syphilis_positive'])) $prenatalStats['syphilis_positive']++;
        if (!empty($row['hepB_screened'])) $prenatalStats['hepB_screened']++;
        if (!empty($row['hepB_positive'])) $prenatalStats['hepB_positive']++;
        if (!empty($row['hiv_screened'])) $prenatalStats['hiv_screened']++;
        if (!empty($row['cbc_tested'])) $prenatalStats['cbc_tested']++;
        if (!empty($row['cbc_anemia'])) $prenatalStats['cbc_anemia']++;
        if (!empty($row['gestational_diabetes_screened'])) $prenatalStats['gestational_diabetes_screened']++;
        if (!empty($row['gestational_diabetes_positive'])) $prenatalStats['gestational_diabetes_positive']++;
    }
}

// Example: Query for age groups
$ageGroups = [
    '10-14' => ['checkups' => 0, 'deliveries' => 0],
    '15-19' => ['checkups' => 0, 'deliveries' => 0],
    '20-49' => ['checkups' => 0, 'deliveries' => 0],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenatal Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .print-button {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Prenatal Care Report</h1>
    <h2>Maternal Care and Services</h2>

    <button class="print-button" onclick="window.print()">Print Report</button>

    <table>
        <thead>
            <tr>
                <th>Indicator</th>
                <th>Total</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Women with at least 4 prenatal check-ups</td>
                <td><?php echo $prenatalStats['4_checkups']; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>Women who completed calcium supplementation</td>
                <td><?php echo $prenatalStats['calcium_supplementation']; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>Women given iodine capsules</td>
                <td><?php echo $prenatalStats['iodine_capsules']; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>Women given one dose of deworming tablets</td>
                <td><?php echo $prenatalStats['deworming_tablets']; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>Women screened for syphilis</td>
                <td><?php echo $prenatalStats['syphilis_screened']; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>Women tested positive for syphilis</td>
                <td><?php echo $prenatalStats['syphilis_positive']; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>Women screened for Hepatitis B</td>
                <td><?php echo $prenatalStats['hepB_screened']; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>Women tested positive for Hepatitis B</td>
                <td><?php echo $prenatalStats['hepB_positive']; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>Women screened for HIV</td>
                <td><?php echo $prenatalStats['hiv_screened']; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>Women tested for CBC</td>
                <td><?php echo $prenatalStats['cbc_tested']; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>Women diagnosed with anemia</td>
                <td><?php echo $prenatalStats['cbc_anemia']; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>Women screened for gestational diabetes</td>
                <td><?php echo $prenatalStats['gestational_diabetes_screened']; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>Women tested positive for gestational diabetes</td>
                <td><?php echo $prenatalStats['gestational_diabetes_positive']; ?></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <h2>Age Group Statistics</h2>
    <table>
        <thead>
            <tr>
                <th>Age Group</th>
                <th>Checkups</th>
                <th>Deliveries</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ageGroups as $ageGroup => $stats): ?>
                <tr>
                    <td><?php echo $ageGroup; ?></td>
                    <td><?php echo $stats['checkups']; ?></td>
                    <td><?php echo $stats['deliveries']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
