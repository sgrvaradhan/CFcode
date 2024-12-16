<?php
//session_start();
//$ir_email = $_SESSION['ir_email'];
require 'db_conn.php';

				


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style_1.css" media="all" type="text/css">
	<title>Center Details W2</title>	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<style> 

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  margin-top: 0px;  
  width: 100%;
  font-size: 16px;
}

td {
  border: 1px solid #dddddd;
  text-align: left;
  color:black;  
  padding: 6px;
}

th {
   border: 1px solid #dddddd;
   text-align: center;
   color:white;
   background-color: darkgreen;  
   padding: 6px;
}



tr:nth-child(even) {
  background-color: lightcyan;
}
</style>




<style> #bothir {border-collapse: collapse;width: 100%;margin:auto;line-height: 1;}#bothir td, #bothir th { line-height: 1;border: 1px solid #ddd;border-color:darkred;padding: 6px;}#bothir tr:nth-child(even){background-color:   #f4ecf7
 ;}#bothir th {padding-top: 6px;padding-bottom: 6px;background-color:   #eafaf1  ;color:#040404;}


</style>
<body >
<div id="page1" >

<?php 

$result2 = mysqli_query($connect,"SELECT * FROM exam_center_details where is_w2 ='Y' and center_name <> 'GATE Office'");
                

while($row2 = mysqli_fetch_array($result2)) 
{
  ?>



<div class="row">
<div class="col-100">
<input type="hidden" id="emp_id" name="emp_id" value="<?php echo $row1['emp_id']; ?>">
<input type="hidden" id="emp_id" name="ir_email" value="<?php echo $row1['ir_email']; ?>">
</div>
</div>
<div>
<h3 style="text-align:center; color:brown;">
  <?php


$g_code = $row2['center_code'];
	$j_code = $row2['j_c_code'];
	$ccol = '';
	$ccol1 = '';
	if($row2['is_one_w2'] =='D4' && ($row2['ses5'] == 0 && $row2['ses6'] == 0)){
		$ccol = 'red';
		$ccol1 = '[One Day : Sunday] ' ;
	}
	if($row2['is_one_w2'] =='D3' && ($row2['ses7'] == 0 && $row2['ses8'] == 0)){
		$ccol = 'green';
		$ccol1 = '[One Day : Saturday] ' ;
	}

	if($j_code == 800){
		$j_code = '';
	}

  $excentercode =" $g_code";
  $isexam = 'GATE';   
  $po_name = str_replace("/","<br>",$row2['po_name']);
  $po_mobile = str_replace("/","<br>",$row2['po_mobile']);
  $po_email = str_replace("/","<br>",$row2['po_email']);
  $po_de = str_replace("/","<br>",$row2['po_design']);
  $dpo_name = str_replace("/","<br>",$row2['dpo_name']);
  $dpo_mobile = str_replace("/","<br>",$row2['dpo_mobile']);
  $dpo_email = str_replace("/","<br>",$row2['dpo_email']);
  $dpo_de = str_replace("/","<br>",$row2['dpo_design']);
  $tcs_c_name  = str_replace("/","<br>",$row2['tcs_c_name']);
  $tcs_c_email  = str_replace("/","<br>",$row2['tcs_c_email']);
  $tcs_c_mobile  = str_replace("/","<br>",$row2['tcs_c_mobile']);

  if($row2['isgatejam'] =="Y"){
    $examcenter_code = " GATE- ".$g_code ."<br> JAM- ".$j_code;  
    }
    else{
      $examcenter_code  = $g_code;  
    }

echo $isexam;
?> 2024 <b>Center Personnel Details Week 2</b> <br>

<?php echo "(".$excentercode." : ".$row2['center_name']." - ".$row2['c_city'] ." )";?></h3>
</div>



<table id="bothir" >
<tr>
<th colspan=3>
Center Address Details
</th>
<th  style=" width:50px">
Session
</th>
<th  style=" width:75px">
Count
</th>
<th  style=" width:50px">
PwD Count
</th>
<th style=" width:50px">
No. of Pages in Roll List
</th>
</tr>
<tr>
<td colspan=3 rowspan=4>
<?php echo '<b>Center Code:'. $row2['center_code']."</b>&nbsp<b style=color:".$ccol.";>".$ccol1."</b>";?></p>

<p><?php
echo $row2['center_name']."<br>".$row2['c_address1'];

if(!empty($row2['c_address2'])){
    echo "<br>". $row2['c_address2'];
    }
if(!empty($row2['c_address_3'])){
echo "<br>". $row2['c_address_3'].",";
}

?>

<?php echo $row2['c_city'];?>,&nbsp<?php echo $row2['c_state'];?>&nbsp-&nbsp<?php echo $row2['c_pincode'];?></p>



</td>
<?php 
$pwd_count = explode("|",$row2['no_pwd_count']);


?>
<td colspan=1 style='text-align: center;'>
<?php echo "S5</td><td style='text-align: center;'> " .$row2['ses5']; ?> </td><td style='text-align: center;'><?php echo $pwd_count[4];?></td><td style='text-align: center;'><?php echo "".(ceil($row2['ses5']/20))?><br></td>
</tr>
<tr>
<td colspan=1 style='text-align: center;'>
<?php echo "S6</td><td style='text-align: center;'> " .$row2['ses6']; ?> </td><td style='text-align: center;'> <?php echo $pwd_count[5];?></td><td style='text-align: center;'> <?php echo "".(ceil($row2['ses6']/20))?></td></tr><tr>
<td colspan=1 style='text-align: center;'>
<?php echo "S7</td><td style='text-align: center;'> " .$row2['ses7']; ?></td><td style='text-align: center;'><?php echo $pwd_count[6];?></td><td style='text-align: center;'> <?php echo "".(ceil($row2['ses7']/20))?></td></tr><tr>
<td colspan=1 style='text-align: center;'>
<?php echo "S8</td><td style='text-align: center;'> " .$row2['ses8']; ?> </td><td style='text-align: center;'><?php echo $pwd_count[7];?></td><td style='text-align: center;'> <?php echo "".(ceil($row2['ses8']/20))?>



 







</td></tr>

</table>
<table id="bothir">

<tr>
  <th colspan=4>
Contact Details of the Personnel at the allotted Center
</th>
</tr>

<tr>
  <th colspan=4>
College / Center Personnel
</th>
</tr>

<tr>
<th rowspan=2>Name </th>
  <th >
  Presiding Officer (PO)
</th>
<th >
Deputy Presiding Officer (DPO)
</th>
<th >
TCS Venue Commanding Officer
</th>
</tr>


<tr>
<td><?php echo $po_name;?></td>
<td><?php echo $dpo_name;?></td>
<td><?php echo $tcs_c_name;?></td>
</tr>




<tr>
 <th>Email ID </th>
  
  <td><?php echo $po_email;?></td>
  <td><?php echo $dpo_email;?></td>
  <td><?php echo $tcs_c_email;?></td>

</tr>

<tr>
 <th>Mobile No. </th>  
  <td><?php echo $po_mobile;?></td>
  <td><?php echo $dpo_mobile;?></td>
  <td><?php echo $tcs_c_mobile;?></td>

</tr>




</table>
<table id="bothir">

<tr>
<th colspan=4>Institute Representatives (IRs)</th>
</tr>
      
       <tr>  
         <th>S.No.</th> 
         <th>Name</th> 
         <th>Email ID</th> 
         <th>Mobile Number</th> 
</tr>
   
<tr>


 

<?php
$i=1;
$fetchirde = mysqli_query($connect,"SELECT * FROM irdetails where (ir_center_code_1 ='$j_code' or  ir_allotted_centre_code='$g_code') and ir_exam_S in ('W2-GATE','W2-D3-GATE','W2-D4-GATE','W2-GATE-JAM') order by ir_identify asc,irrank asc");
while($row3 = mysqli_fetch_array($fetchirde))
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

<tr>

<td style="text-align: center;"><?php echo $i; ?></td>

          <td><?php echo $row3["Personal_Titles"]." ".ucwords(strtolower($row3["ir_name"])); ?></td>            
          <td><?php echo $iit_name_email; ?></td>
          <td><?php echo $row3["ir_mobile"]; ?></td>


        
                    
          
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

</body>     
</html>


