<?php
$colors = array('#000000', '#111111', '#1D2029', '#2174A1', '#2B2C2B', '#333333', '#558855', '#581414', '#584E3B', '#5E727D', '#666666', '#777777', '#888888', '#993333', '#999999', '#A4A190', '#A89E8B', '#ACACAC', '#BBBBBB', '#C8C2B5', '#CCCCCC', '#CCDDBB', '#CCEECC', '#D3CDBF', '#DDDDDD', '#EECCEE', '#EEEEEE', '#F3F3F3', '#F9F9F9', '#FF88FF', '#FFFFFD', '#FFFFFF',);
?>
<html>
<head>
</head>
<body>
<table>
<tr>
<th>Value</th>
<th>Color</th>
</tr>
<?php
foreach ($colors as $color) {
  echo '<tr>';
  echo '<td>' . $color . '</td>';
  echo '<td style="width: 150px; background-color: ' . $color . ';"></td>';
  echo '</tr>';
}
?>
</table>
</body>
</html>
