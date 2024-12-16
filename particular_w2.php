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
	<title>Particular W2</title>	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<style> 

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  margin-top: 0px;  
  width: 100%;
  font-size: 20px;
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




<style> #bothir {border-collapse: collapse;width: 100%;margin:auto;line-height: 1.8;}#bothir td, #bothir th { line-height: 1.8;border: 1px solid #ddd;border-color:darkred;padding: 8px;}#bothir tr:nth-child(even){background-color: #eafaf1;}#bothir th {padding-top: 6px;padding-bottom: 6px;background-color: #fdedec ;color:#040404}


</style>
<body>


<?php 

$result2 = mysqli_query($connect,"SELECT * FROM exam_center_details where is_w2 ='Y' and center_name <> 'GATE Office'");
                

while($row2 = mysqli_fetch_array($result2)) 
{
  ?>

<div class="card" style="font-family: Arial, Helvetica, sans-serif;color:#4D4D4D; margin:auto; width:100%;">

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
	if($row2['is_one_w2'] =='D4' && ($row2['ses6'] == 0 && $row2['ses5'] == 0)){
		$ccol = 'red';
		$ccol1 = '[One Day : Sunday] ' ;
	}
	if($row2['is_one_w2'] =='D3' && ($row2['ses7'] == 0 && $row2['ses7'] == 0)){
		$ccol = 'green';
		$ccol1 = '[One Day : Saturday] ' ;
	}

	if($j_code == 800){
		$j_code = '';
	}

  
  if($row2['isgatejam'] =="Y"){
    $examcenter_code = " GATE- ".$g_code ."<br> JAM- ".$j_code;  
    }
    else{
      $examcenter_code  = $g_code;  
    }


  $excentercode =" $g_code";
  $isexam = 'GATE';   
  $po_name = $row2['po_name'];
  $po_mobile = $row2['po_mobile'];
  $po_email = $row2['po_email'];
  $po_de = $row2['po_design'];
  $dpo_name = $row2['dpo_name'];
  $dpo_mobile = $row2['dpo_mobile'];
  $dpo_email = $row2['dpo_email'];
  $dpo_de = $row2['dpo_design'];
  $tcs_c_name  = $row2['tcs_c_name'];
  $tcs_c_email  = $row2['tcs_c_email'];
  $tcs_c_mobile  = $row2['tcs_c_mobile'];




?> 
</div>



<table id="bothir" >
<tr>
<th width="150px">GATE 2024<br><img src="IIT_Madras-2.png" width="50px" height="50px"><br>IIT Madras</th>
<th>
<?php echo $row2['center_name'];?> - <?php echo $row2['c_city'];?>
</th>

<th width="150px">
<?php echo '<b>'. $g_code."</b><br>".$ccol1."</b>";?>
</th>
</tr>
<tr>
  <td colspan=3 style="text-align: center;font-size:medium;">
  <b>Center File - W2</b>
  </td>
</tr>

<tr>
  <td colspan=3 style="text-align: center;font-size:medium;">
  <b>Particulars</b>
  </td>
</tr>

<tr>
  <td colspan=3>
  <ol>
  <li>
Institute Representative (IR) allocation letter
</li>

<li>
MoE Letter
</li>

<li>
Session wise candidate count at the Center, and contact details of PO, DPO, TCS Centre Head, IRs
</li>
<li>
Details of IRs going to the same city
</li>

<li>
List of PwD Candidates, Scribe requirement (if any)
</li>
<li>
Scribe Declaration Form (if applicable)
</li>
<li>
List of Provisional Candidates (if any)
</li>
<li>
Copy of letters sent to Home Secretary, Director General of Police, District Magistrate, District Collector and Commissioner of Police/Superintendent of Police
</li>
</ol>
</td>
<tr>
</table>
<p><b>Note: IRs should be extra vigilant throughout the examination in view of safety issues raised by TCS.</b></p>
<div style="page-break-after: always;"></div>
<?php

}

?>

</body>     
</html>


