<?php
require 'db_conn.php';		
#SELECT DISTINCT `Center Code` FROM provisional;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provisional W2</title>
    <style>
        #page1{height:auto; width:240mm; font-family: Arial, Helvetica, sans-serif;} 
        #customers {border-collapse: collapse;width: 100%; font-family: Arial, Helvetica, sans-serif;}
        #customers td, #customers th { border: 1px solid #ddd;padding: 4px;padding-left: 12px;}
        #customers tr:nth-child(even){background-color: #ffffcc;}
        #customers th {padding-top: 6px;padding-bottom: 6px;background-color: #530802;color: #fefefe;}
        #headtb {font-family: arial, sans-serif;border-collapse: collapse; width: 100%;}
        #headtb td {border:2px solid brown;text-align: left;color:black;  margin: 0px;}
    </style>
</head>
<body>
    <div>
    <?php 
$result2 = mysqli_query($connect,"SELECT DISTINCT `Centre_code` FROM provisional where Weeks = 'W2'"); #fetch provisional candidate centres              
while($row2 = mysqli_fetch_array($result2)) 
{ 
    $gc_code = $row2['Center_Code'];
    $cc2 = mysqli_fetch_array(mysqli_query($connect,"SELECT center_code, center_name FROM exam_center_details where center_code ='$gc_code'"));
    ?>
    <table id="headtb" >
        <tr><td rowspan="2"><h2 style="text-align:center;">GATE 2025</h2></td><td><h3  style="text-align:center;"> Provisional Candidates List - Week 1 </h3></td></tr>
        <tr><td><h4 style="text-align:center;"><?php echo $cc2["center_code"]; ?> - <?php echo $cc2["center_name"]; ?></h4></td></tr>
    </table>
    
    <table id="customers"><thead><tr><th>S.No</th><th>Registration No</th><th>Session</th><th>Name of the Candidate</th></tr></thead>
    <?php      
        $i=1;
        $fetchstud = mysqli_query($connect,"SELECT * FROM provisional where Centre_code ='$gc_code' and Weeks = 'W2'"); #fetch provisional candidate
        while($row3 = mysqli_fetch_array($fetchstud))
        { ?> 
            <tr><td style="text-align: center;"><?php echo $i; ?></td>
            <td><?php echo $row3["Registration No"]; ?></td>
            <td ><?php echo $row3["Session"]; ?></td>
            <td><?php echo $row3["Name"]; ?></td></tr>
        <?php
        $i++;
        }   
?></table><br><table style="page-break-after:always" width="100%"><tr><td float="left">Notes: <br>Do not collect any documents from the provisional candidates and let them take the exam.</td></tr></table>
<div style="page-break-after: always;"></div>
<?php
}
  ?>
  
</div>
</body>
</html>
