<?php 
require 'db_conn.php';		
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #page1{height:auto; width:240mm; font-family: Arial, Helvetica, sans-serif;} 
        #customers {border-collapse: collapse;width: 100%; font-family: Arial, Helvetica, sans-serif;}
        #customers td, #customers th { border: 1px solid #ddd;padding: 4px;padding-left: 12px;}
        #customers tr:nth-child(even){background-color: #dafcdc ;}
        #customers th {padding-top: 6px;padding-bottom: 6px;background-color: #09820f;color: #ffffff;}
        #headtb {font-family: arial, sans-serif;border-collapse: collapse; width: 100%;}
        #headtb td {border:2px solid green;text-align: left;color:black;  margin: 0px;}
    </style>   
</head>
<body>
    <div>
        <?php
        $citydet = mysqli_query($connect,"SELECT DISTINCT `adexamcity` FROM `exam_center_details`");
        while($row1 = mysqli_fetch_array($citydet)) 
        { 
            $g_city = $row1['adexamcity'];?>
            <p ><h3 style="text-align:center;">GATE - JAM 2025 Center Details in  <?php echo $row1["adexamcity"]; ?> </h3></p>
            <table id="customers" >
                <thead>
                <th>S.No</th><th>Centre Code</th><th>Centre details</th><th>Presiding Officer Details (PO)</th>
                </thead>
                <?php 
                    $i=1;
                    $centdet = mysqli_query($connect,"SELECT * FROM `exam_center_details` where adexamcity ='$g_city'");
                    while($row2 = mysqli_fetch_array($centdet)) 
                        { ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $i; ?></td>
                                <td style="text-align: center;"><b><?php echo $row2["center_code"]; ?></b></td>
                                <td><?php echo $row2["center_name"]; ?><br><?php echo $row2["c_address1"]; ?></td>
                                <td><?php echo $row2["po_name"]; ?><br><?php echo $row2["po_mobile"]; ?><br><?php echo $row2["po_email"]; ?></td>
                        <?php }?>
            </table>
            <div style="page-break-after: always;"></div>
        <?php
        }?>
    </div>
    
</body>
</html>