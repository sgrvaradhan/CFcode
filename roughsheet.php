<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csvFile'])) {
    // Upload folder
    $uploadDir = 'assets/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create the folder if it doesn't exist
    }

    // Get uploaded file information
    $uploadedFile = $_FILES['csvFile'];
    $tmpFilePath = $uploadedFile['tmp_name'];
    $fileError = $uploadedFile['error'];

    // Check for upload errors
    if ($fileError === UPLOAD_ERR_OK) {
        // Convert CSV to JSON
        $jsonData = convertCsvToJson($tmpFilePath);

        // Save JSON to data.json in the assets folder
        $jsonFilePath = $uploadDir . 'data.json';
        file_put_contents($jsonFilePath, $jsonData);

        echo "File successfully uploaded and converted to JSON. Saved as <strong>$jsonFilePath</strong>.";
    } else {
        echo "Error uploading file. Error code: $fileError";
    }
}

// Function to convert CSV to JSON
function convertCsvToJson($filePath)
{
    $csvFile = fopen($filePath, 'r');
    $csvData = [];
    $headers = fgetcsv($csvFile); // Get the first row as headers

    while (($row = fgetcsv($csvFile)) !== false) {
        $csvData[] = array_combine($headers, $row);
    }

    fclose($csvFile);

    return json_encode($csvData, JSON_PRETTY_PRINT);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV and Convert to JSON</title>
</head>
<body>
    <h1>Upload CSV File</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="csvFile">Select CSV File:</label>
        <input type="file" name="csvFile" id="csvFile" accept=".csv" required>
        <br><br>
        <button type="submit">Upload and Convert</button>
    </form>
</body>
</html>
