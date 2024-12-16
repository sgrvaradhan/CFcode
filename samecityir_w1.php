<?php
require 'db_conn.php';		
#SELECT DISTINCT `Center Code` FROM provisional; adexamcity SELECT `adexamcity`FROM `exam_center_details` WHERE 1;
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
            <p ><h3 style="text-align:center;">GATE 2025 <?php echo $row1["adexamcity"]; ?> city Centre details - Week 1</h3></p>
            <table id="customers">
                <thead><th>S.No</th><th>Centre details</th><th>PO and DPO details</th><th>TCS venue Head</th><th>Institute Representatives IRs</th></thead>
                <?php 
                    $i=1;
                    $centdet = mysqli_query($connect,"SELECT * FROM `exam_center_details` where adexamcity ='$g_city'");
                    while($row2 = mysqli_fetch_array($centdet)) 
                        { ?>
                            <tr><td style="text-align: center;"><?php echo $i; ?></td>
                            <td><b> Centre Code:<?php echo $row2["center_code"]; ?></b><br><?php echo $row2["center_name"]; ?><br><?php echo $row2["c_address1"]; ?></td>
                            <td><?php echo $row2["po_name"]; ?><br><?php echo $row2["po_mobile"]; ?><br><?php echo $row2["po_email"]; ?><hr><?php echo $row2["dpo_name"]; ?><br><?php echo $row2["dpo_mobile"]; ?><br><?php echo $row2["dpo_email"]; ?> </td>
                            <td><?php echo $row2["tcs_c_name"]; ?><br><?php echo $row2["tcs_c_mobile"]; ?><br><?php echo $row2["tcs_c_email"]; ?></td>
                            <td>
                            <?php
                                $g_city = $row1['adexamcity'];
                                $cc_code = $row2['center_code'];
                                $mg_city = substr($g_city, 0, -5); 
                                $irdet = mysqli_query($connect,"SELECT * FROM `irdetails` where ir_allotted_city ='$mg_city' and ir_allotted_centre_code='$cc_code' and ir_exam_S in ('W1-GATE','W1-D2-GATE','W1-D1-GATE') ");
                                while($row3 = mysqli_fetch_array($irdet))
                                {
                                    
                                    $fstchar = substr($row3['emp_id'], 0,1);	 
                                        if($fstchar == "P"){
                                            $iit_name ="IIT Palakkad";
                                            $iit_name_email = $row3["ir_email"]."@iitpkd.ac.in";
                                            }
                                            elseif($fstchar == "T"){
                                            $iit_name ="IIT Tirupati";
                                            $iit_name_email = $row3["ir_email"]."@iittp.ac.in";
                                            }
                                            else{
                                            $iit_name_email= $row3["ir_email"]."@iitm.ac.in";
                                            $iit_name =$row3["emp_id"];
                                            }

                                    ?>
                                 <?php echo $row3["Personal_Titles"]." ".trim(ucwords(strtolower($row3["ir_name"]))); ?><br><?php echo $row3["ir_mobile"]; ?></br><?php echo $iit_name_email; ?><br><hr>
                               <?php }
                            ?>
                            </td>
                        </tr>
                        <?php
                        $i++;
                        }
                        ?>

                
            </table>
            <div style="page-break-after: always;"></div>
        <?php
        }
        ?>
        
    </div>
</body>
</html>

