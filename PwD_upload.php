<?php
require 'db_conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="row">
    <!-- Import link -->
    <div class="col-md-12 head">
        <div class="float-end">
            <a href="javascript:void(0);" class="btn btn-primary" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
        </div>
    </div>
    <!-- CSV file upload form -->
    <div class="col-md-12" id="importFrm" style="display: none;">
        <form action="import.php" method="post" class="row g-2 float-end" enctype="multipart/form-data">
            <div class="col-auto">
                <input type="file" name="file" class="form-control" required/>

                <!-- Link to download sample format -->
                <p class="text-start mb-0 mt-2">
                    <a href="sample-csv-members.csv" class="link-primary" download>Download Sample Format</a>
                </p>
            </div>
            <div class="col-auto">
                <input type="submit" class="btn btn-success mb-3" name="importPwD" value="Import CSV">
            </div>
            
        </form>
        
    </div>
    <form action="import.php" method="post">
            <div class="col-auto">
                <input type="submit" class="btn btn-success mb-3" name="DeletePwD" value="Clean the table">
            </div>
        </form>
    <!-- Data list table --> 
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>

                <th>S.no</th>
                <th>Centre Code</th>
                <th>Registration No</th>
                <th>Session</th>
                <th>Name of the Candidate</th>
                <th>Scribe requirements</th>
                <th>Weeks</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        // Fetch member records from database 
        //$result = $db->query("SELECT * FROM members ORDER BY id DESC"); 
        $i=1;
        $result = mysqli_query($connect,"SELECT * FROM pwd_cand");
        if($result->num_rows > 0){ 
            while($row = mysqli_fetch_array($result)){ 
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['Centre_code']; ?></td>
                <td><?php echo $row['Registration_No']; ?></td>
                <td><?php echo $row['Session']; ?></td>
                <td><?php echo $row['Name']; ?></td>
                <td><?php echo $row['Scribe']; ?></td>
                <td><?php echo $row['Weeks']; ?></td>
            </tr>
        <?php $i++;} }
        else{ ?>
            <tr><td colspan="5">No member(s) found...</td></tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<!-- Show/hide CSV upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
</body>
</html>
