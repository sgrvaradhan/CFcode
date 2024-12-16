
<?php
// Path to the external JSON file
$jsonFilePath = 'assets/data.json';

// Check if the file exists
if (file_exists($jsonFilePath)) {
    // Read and decode the JSON file
    $jsonData = file_get_contents($jsonFilePath);
    $dataArray = json_decode($jsonData, true); // Decode JSON into an associative array
} else {
    die("JSON file not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authority Letter Week1</title>
    <style>
        img {width: 1080px;height:1430px; } 
        .blank {width: 1080px;height:1490px; } 
        @page {size: A4;margin-left: 0mm;margin-right: 0mm;margin-top: 5mm;margin-bottom: 3mm; }
        .top-left {  position: absolute;  top: 8px;  left: 16px;}
        .container {  position: relative;  text-align: center;  color: red;font-size: 16px;} 
   </style>
</head>
<body>
    <?php
            // Loop through the data array and generate table rows
        foreach ($dataArray as $row ) {
            if($row['is_w1']=="Y"){
                echo "<div class='container'>";
                echo "<h4>". htmlspecialchars($row['g_code']) . "-" . htmlspecialchars($row['Center Name']) ." Week1</h4>";
                echo "<img src='assets/HS/". htmlspecialchars($row['State']) .".jpg' alt='J-HS' >";
                echo "<h4>". htmlspecialchars($row['g_code']) . "-" . htmlspecialchars($row['Center Name']) ." Week1</h4>";
                echo "<img src='assets/DGP/". htmlspecialchars($row['State']) .".jpg' alt='J-HS' >";
                echo "<h4>". htmlspecialchars($row['g_code']) . "-" . htmlspecialchars($row['Center Name']) ." Week1</h4>";
                echo "<img src='assets/DC/". htmlspecialchars($row['Dist_coll']) .".jpg' alt='J-HS' >";
                echo "<h4>". htmlspecialchars($row['g_code']) . "-" . htmlspecialchars($row['Center Name']) ." Week1</h4>";
                echo "<img src='assets/DM/". htmlspecialchars($row['Dist_magis']) .".jpg' alt='J-HS' >";
                echo "<h4>". htmlspecialchars($row['g_code']) . "-" . htmlspecialchars($row['Center Name']) ." Week1</h4>";
                echo "<img src='assets/SP/". htmlspecialchars($row['sp']) .".jpg' alt='J-HS' >";
                echo "<div class='blank'></div >";
                echo "</div>";
            }
        }
        ?>
        

</div>
</body>
</html>
<!--

    -->