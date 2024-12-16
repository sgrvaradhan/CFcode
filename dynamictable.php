<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dynamic Table Styler</title>
  <style>
    body {
      display: flex;
      margin: 0;
      font-family: Arial, sans-serif;
    }
    .sidenav {
      width: 250px;
      background-color: #f4f4f4;
      padding: 15px;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
      height: 100vh;
    }
    .main {
      flex: 1;
      padding: 20px;
    }
    table {font-family: arial, sans-serif;
      width: 100%;
      border-collapse: collapse;
      text-align: left;font-size: 20px;
    }
    th, td {
      padding: 10px;
      border: 1px solid #ddd;
    }th{text-align: center;}
  </style>
</head>
<body>

<div class="sidenav">
  <h3>Table Styler</h3>
  <input type="radio" id="Week1" name="WeekofExam" value="Week1">
  <label for="Week1">Week 1</label><br>
  <input type="radio" id="Week2" name="WeekofExam"  value="Week2">
  <label for="Week2">Week 2</label><br>
  <hr><br>
  <label for="hdColor">Header Background:</label>
  <input type="color" id="hdColor" value="#000000"><br><br>

  <label for="textColor">Text Color:</label>
  <input type="color" id="textColor" value="#000000"><br><br>

  <label for="bgColor">Background Color:</label>
  <input type="color" id="bgColor" value="#ffffff"><br><br>

  <label for="borderStyle">Border Style:</label>
  <select id="borderStyle">
    <option value="solid">Solid</option>
    <option value="dotted">Dotted</option>
    <option value="dashed">Dashed</option>
    <option value="double">Double</option>
  </select><br><br>

  <label for="borderWidth">Border Width:</label>
  <input type="range" id="borderWidth" min="1" max="10" value="1"><br><br>

  <button id="generateCss">Generate CSS File</button>
</div>

<div class="main">
  <h1>Dynamic Table</h1>
  <table id="mainTable">
    <tr id="mainTablehd">
      <th width="150px">GATE 2024<br><img src="IIT_Madras-2.png" width="50px" height="50px"><br>IIT Madras</th>
      <th >Centre name - City</th>
      <th width="150px"> 7101 <br> one - day</th>
    </tr>
    <tr>
      <td colspan=3 style="text-align: center;font-size:medium;">
      <b>Center File - W1</b>
      </td>
    </tr>

    <tr>
      <td colspan=3 style="text-align: center;font-size:medium;"><b>Particulars</b></td>
    </tr>

    <tr>
      <td colspan=3>
        <ol>
        <li>Institute Representative (IR) allocation letter</li>
        <li>MoE Letter</li>
        <li>Session wise candidate count at the Center, and contact details of PO, DPO, TCS Centre Head, IRs</li>
        <li>Details of IRs going to the same city</li>
        <li>List of PwD Candidates, Scribe requirement (if any)</li>
        <li>Scribe Declaration Form (if applicable)</li>
        <li>List of Provisional Candidates (if any)</li>
        <li>Copy of letters sent to Home Secretary, Director General of Police, District Magistrate, District Collector and Commissioner of Police/Superintendent of Police</li>
        </ol>
      </td>
    <tr>

  </table>
</div>

<script>
  // Get elements
  const table = document.getElementById('mainTable');
  const textColorPicker = document.getElementById('textColor');
  const bgColorPicker = document.getElementById('bgColor');
  const hdColorPicker = document.getElementById('hdColor');
  const borderStyleSelector = document.getElementById('borderStyle');
  const borderWidthSlider = document.getElementById('borderWidth');
  const generateCssButton = document.getElementById('generateCss');
  const tableHeader = document.querySelector("#mainTablehd");

  // Initial CSS variables
  let textColor = textColorPicker.value;
  let bgColor = bgColorPicker.value;
  let borderStyle = borderStyleSelector.value;
  let borderWidth = borderWidthSlider.value;

  // Update CSS dynamically
  textColorPicker.addEventListener('input', () => {
    textColor = textColorPicker.value;
    table.style.color = textColor;
  });

  bgColorPicker.addEventListener('input', () => {
    bgColor = bgColorPicker.value;
    table.style.backgroundColor = bgColor;
  });
  hdColorPicker.addEventListener('input', () => {
    hdColor = hdColorPicker.value;
    tableHeader.style.backgroundColor = hdColor;
  });

  borderStyleSelector.addEventListener('change', () => {
    borderStyle = borderStyleSelector.value;
    table.style.borderStyle = borderStyle;
  });

  borderWidthSlider.addEventListener('input', () => {
    borderWidth = borderWidthSlider.value;
    table.style.borderWidth = `${borderWidth}px`;
  });

  // Generate and download CSS file
  generateCssButton.addEventListener('click', () => {
    const cssContent = `
      table {
        font-family: arial, sans-serif;
        color: ${textColor};
        background-color: ${bgColor};
        border-style: ${borderStyle};
        border-width: ${borderWidth}px;
      }
      th{background-color: ${hdColor};}
      th, td {
        padding: 10px;
        border: ${borderWidth}px ${borderStyle} #ddd;
      }
    `;

    const blob = new Blob([cssContent], { type: 'text/css' });
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'table-styles.css';
    link.click();
  });
</script>

</body>
</html>
