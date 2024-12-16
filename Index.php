<?php
require 'db_conn.php';		
#SELECT DISTINCT `Center Code` FROM provisional; adexamcity SELECT `adexamcity`FROM `exam_center_details` WHERE 1;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dynamic Page Load</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            /* Basic styling */
            body {
                font-family: Arial, sans-serif;
            }
            .sidebar {
                width: 200px;
                height: 100%;
                float: left;
                background-color: #5f2fc7;
                height: 100vh;
                padding: 10px;
                z-index: 1; top: 0; left: 0;
                overflow-x: hidden;
                padding-top: 20px; 
                position: fixed;
                
            }
            .sidebar h3{color:#fff;}
            .sidebar a {
                display: block;
                margin-bottom: 10px;
                padding: 6px 8px 6px 16px;
                color: #fff;
                text-decoration: none;
                font-size: 16px;
            }
            .sidenav a:hover {
            color: #f1f1f1;
            }
            .main {
            margin-left: 200px; /* Same as the width of the sidenav */  
            padding: 0px 10px;
            }

            .top-section {
                height: 150px;
                width:100%;
                background: #ddd;
                padding: 20px;
                position: fixed;
            }
            /* Bottom section */
            .bottom-section {            
                flex-grow: 1;
                background: #fff;
                padding: 20px;
                overflow-y: auto;
                overflow: auto;
            }

            button {
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                border: none;
                cursor: pointer;
                border-radius: 5px;
            }

            button:hover {
                background-color: #0056b3;
            }
            .float{position:fixed;width:60px;height:60px;bottom:40px;right:40px;background-color:#0C9;color:#FFF;border-radius:50px;text-align:center;box-shadow: 2px 2px 3px #999;}
            .my-float{margin-top:15px;}
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
        <script>
            // JavaScript to handle content loading
            function loadContent(page) {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', page, true);
                xhr.onload = function () {
                    if (this.status === 200) {
                        document.getElementById('bottom-section').innerHTML = this.responseText;
                    } else {
                        document.getElementById('bottom-section').innerHTML = '<p>Error loading page.</p>';
                    }
                };
                xhr.send();
            }
            // Trigger the print dialog
            function printContent() {
                const bottomSection = document.getElementById('bottom-section').innerHTML;
                const printWindow = window.open('', '', 'height=900,width=900');
                printWindow.document.write('<html><head><title>Print</title></head><body>');
                printWindow.document.write(bottomSection);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
            }
        </script>
    </head>
    <body>
        <div class="sidebar">
            <h3>Centre File</h3><hr>
            <a href="#" onclick="loadContent('particular_w1.php'); return false;">Particular Week1</a>
            <a href="#" onclick="loadContent('particular_w2.php'); return false;">Particular Week2</a>
            <a href="#" onclick="loadContent('centredet_w1.php'); return false;">Centre detail Week1</a>
            <a href="#" onclick="loadContent('centredet_w2.php'); return false;">Centre detail Week2</a>
            <a href="#" onclick="loadContent('samecityir_w1.php'); return false;">Same City IR Week1</a>
            <a href="#" onclick="loadContent('samecityir_w2.php'); return false;">Same City IR Week2</a>
            <a href="#" onclick="loadContent('pwd_w1.php'); return false;">PwD candidate Week1</a>
            <a href="#" onclick="loadContent('pwd_w2.php'); return false;">PwD candidate Week2</a>
            <a href="#" onclick="loadContent('provisional_w1.php'); return false;">Provisional Week1</a>
            <a href="#" onclick="loadContent('provisional_w2.php'); return false;">Provisional Week2</a>
            <a href="authltr_W1.php" target="blank">Authority Letter Week1</a>
            <a href="authltr_W2.php" target="blank" >Authority Letter Week2</a>
            <a href="#" onclick="loadContent('page5.php'); return false;">Page 5</a>
        </div>
        <a href="#" class="float" onclick="printContent()"><i class="fa fa-print my-float" style="font-size:30px;color:white"></i></a>
        <!-- Main container -->
            <div class="main bottom-section" id="bottom-section">
                <h2>Welcome</h2>
                <p>Following content downloaded here.</p>
                <ol>   
                    <li>Particular</li>
                    <li>Center and contact details </li>
                    <li>Details of IRs going to the same city</li>
                    <li>List of PwD Candidates, Scribe requirement (if any)</li>
                    <li>List of Provisional Candidates (if any)</li>
                </ol>
            </div>
    </body>
</html>

