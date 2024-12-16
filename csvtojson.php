<?php
require 'db_conn.php';	    
$error = '';
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
if(isset($_POST['importProv']))
{ 
    // Allowed mime types 
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel');     
    // Validate whether selected file is a CSV file 
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){         
        // If the file is uploaded 
        if(is_uploaded_file($_FILES['file']['tmp_name'])){             
            // Open uploaded CSV file with read-only mode 
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');             
            // Skip the first line 
            fgetcsv($csvFile);             
            // Parse data from CSV file line by line 
            while(($line = fgetcsv($csvFile)) !== FALSE){ 
                $line_arr = !empty($line)?array_filter($line):''; 
                if(!empty($line_arr)){ 
                    // Get row data 
                    $Centcode   = trim($line_arr[0]); 
                    $Regno  = trim($line_arr[1]); 
                    $Session  = trim($line_arr[2]); 
                    $name = trim($line_arr[3]);
                    $Weeks= trim($line_arr[4]);    
                    $fetchstud = mysqli_query($connect,"INSERT INTO provisional (Centre_code, Registration_No, 	Session, Name, Weeks) VALUES ('".$Centcode."', '".$Regno."', '".$Session."', '".$name."', '".$Weeks."')");
                } 
            }              
            // Close opened CSV file 
            fclose($csvFile);    
        }
    } 
    // Redirect to the listing page 
}

if(isset($_POST['DeleteEntry']))
{ 
    $fetchstud = mysqli_query($connect,"DELETE FROM `provisional`");
    // Redirect to the listing page 

}

if(isset($_POST['importPwD']))
{ 
    // Allowed mime types 
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel');     
    // Validate whether selected file is a CSV file 
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){         
        // If the file is uploaded 
        if(is_uploaded_file($_FILES['file']['tmp_name'])){             
            // Open uploaded CSV file with read-only mode 
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');             
            // Skip the first line 
            fgetcsv($csvFile);             
            // Parse data from CSV file line by line 
            while(($line = fgetcsv($csvFile)) !== FALSE){ 
                $line_arr = !empty($line)?array_filter($line):''; 
                if(!empty($line_arr)){ 
                    // Get row data 
                    $Centcode   = trim($line_arr[0]); 
                     
                    $Session  = trim($line_arr[1]);
                    $Regno  = trim($line_arr[2]); 
                    $name = trim($line_arr[3]);
                    $Scribe = trim($line_arr[4]);
                    $Weeks= trim($line_arr[5]);    
                    $fetchstud = mysqli_query($connect,"INSERT INTO pwd_cand (Centre_code, Registration_No, Session, Name, Scribe, Weeks) VALUES ('".$Centcode."', '".$Regno."', '".$Session."', '".$name."', '".$Scribe."', '".$Weeks."')");
                } 
            }              
            // Close opened CSV file 
            fclose($csvFile);    
        }
    }  
    // Redirect to the listing page 
 
}

if(isset($_POST['DeletePwD']))
{ 
    $fetchstud = mysqli_query($connect,"DELETE FROM `pwd_cand`");
    // Redirect to the listing page 
 
}
?>

<!DOCTYPE html>
<html>
  	<head>
    	<title>Convert CSV to JSON using PHP</title>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="http://code.jquery.com/jquery.js"></script>
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	</head>
  	<body>
<!-- -->
  		<div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Authority details</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if($error != '')
                    {
                    echo '<div class="alert alert-danger">'.$error.'</div>';
                    }
                    ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="col-md-8" text-align="right">
                            <input type="file" name="csvFile" />
                        </div>
                        <div class="col-md-4" text-align="center">
                            <input type="submit" class="btn btn-primary" value="Upload" />
                        </div>
                        <p class="text-start mb-0 mt-2">
                            <a href="sample-csv-members.csv" class="link-primary" download>Download template</a>
                        </p>
                    </form>
                </div>
            </div>
    	</div>
        <!-- -->
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Provisional Candidate list upload here</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if($error != '')
                    {
                    echo '<div class="alert alert-danger">'.$error.'</div>';
                    }
                    ?>
                    <form method="post" enctype="multipart/form-data">
                        <div class="col-md-8">
                            <input type="file" name="file" />
                        </div>
                        <div class="col-md-4" text-align="center">
                            <input type="submit" name="importProv" class="btn btn-primary" value="Upload" />
                        </div>
                        <p class="text-start mb-0 mt-2">
                            <a href="assets/Prov_list_upload.csv" class="link-primary" download>Download template</a>
                        </p>
                    </form>
                </div>
            </div>
    	</div>
        <!-- -->
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">PwD Candidate list upload here</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if($error != '')
                    {
                    echo '<div class="alert alert-danger">'.$error.'</div>';
                    }
                    ?>
                    <form method="post" enctype="multipart/form-data">
                        <div class="col-md-8">
                            <input type="file" name="file" />
                        </div>
                        
                        <div class="col-md-4" text-align="center">
                            <input type="submit" name="importPwD" class="btn btn-primary" value="Upload" />
                        </div>
                        <p class="text-start mb-0 mt-2">
                            <a href="assets/PwD_list_upload.csv" class="link-primary" download>Download template</a>
                        </p>
                    </form>
                </div>
            </div>
    	</div>
  	</body>
</html>