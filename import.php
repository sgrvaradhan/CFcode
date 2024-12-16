<?php
require 'db_conn.php';		


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
header("Location: upload.php"); 
exit();  
}

if(isset($_POST['DeleteEntry']))
{ 
    $fetchstud = mysqli_query($connect,"DELETE FROM `provisional`");
    // Redirect to the listing page 
header("Location: upload.php"); 
exit(); 
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
header("Location: PwD_upload.php"); 
exit(); 
}

if(isset($_POST['DeletePwD']))
{ 
    $fetchstud = mysqli_query($connect,"DELETE FROM `pwd_cand`");
    // Redirect to the listing page 
header("Location: PwD_upload.php"); 
exit(); 
}






 
?>