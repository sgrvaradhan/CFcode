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
	<title>Center Details JAM</title>	
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




<style> #page1{height:auto; width:210mm; font-family: Arial, Helvetica, sans-serif;}#bothir {border-collapse: collapse;width: 100%;margin:auto;line-height: 1;}#bothir td, #bothir th { line-height: 1;border: 1px solid #ddd;border-color:darkred;padding: 6px;}#bothir tr:nth-child(even){background-color:  #eafaf1 ;}#bothir th {padding-top: 6px;padding-bottom: 6px;background-color:#f9ebea;color:  #040404;}


</style>
<body >
<div class="page1" >

<?php 

$result2 = mysqli_query($connect,"SELECT * FROM exam_center_details where is_jam ='Y' and center_name <> 'GATE Office' order by j_c_code asc");
                

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

	if($j_code == 800){
		$j_code = '';
	}

  $excentercode =$row2['j_c_code'];
  $isexam = 'JAM';   
  $po_name = str_replace("/","<br>",$row2['po_jam']);
  $po_mobile = str_replace("/","<br>",$row2['po_jam_mo']);
  $po_email = str_replace("/","<br>",$row2['po_jam_e']);
  $po_de = str_replace("/","<br>",$row2['po_jam_m']);
  $dpo_name = str_replace("/","<br>",$row2['dpo_jam']);
  $dpo_mobile = str_replace("/","<br>",$row2['dpo_jam_mo']);
  $dpo_email = str_replace("/","<br>",$row2['dpo_jam_e']);
  $dpo_de = str_replace("/","<br>",$row2['dpo_jam_d']);  
  $tcs_c_name  = str_replace("/","<br>",$row2['tcs_c_name_j']);
  $tcs_c_email  = str_replace("/","<br>",$row2['tcs_c_email_j']);
  $tcs_c_mobile  = str_replace("/","<br>",$row2['tcs_c_mob_j']);



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
<td colspan=3 rowspan="2">
<?php echo '<b>Center Code:'. $row2['j_c_code']."</b>&nbsp<b style=color:".$ccol.";>".$ccol1."</b>";?></p>
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
<?php echo "J1</td><td style='text-align: center;'> " .$row2['jses1']; ?> </td><td style='text-align: center;'><?php echo $pwd_count[8];?></td><td style='text-align: center;'><?php echo "".(ceil($row2['jses1']/20))?><br></td>
</tr>
<tr>
<td colspan=1 style='text-align: center;'>
<?php echo "J2</td><td style='text-align: center;'> " .$row2['jses2']; ?> </td><td style='text-align: center;'> <?php echo $pwd_count[9];?></td><td style='text-align: center;'> <?php echo "".(ceil($row2['jses2']/20))?></td></tr>


 

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
$gacode=$row2['j_c_code'];
$jcode=$row2['center_code'];
$fetchirde = mysqli_query($connect,"SELECT * FROM irdetails where ir_allotted_centre_code in ('$gacode','$jcode') and ir_exam_S in ('W2-GATE-JAM','W2-JAM') order by ir_identify asc,irrank asc");
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

          <td><?php echo $row3["Personal_Titles"]." ".trim(ucwords(strtolower($row3["ir_name"]))); ?></td>            
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


