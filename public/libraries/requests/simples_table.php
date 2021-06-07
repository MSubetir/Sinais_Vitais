<?php

include("../../database_connect.php");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con, "select *, 
DATE(date) as data, TIME(date) as hora
from users as us
INNER JOIN usersxhistories as ushi
ON us.idUser = ushi.IdUser
INNER JOIN histories as hi
ON ushi.IdHistory = hi.IdHistory
ORDER BY date DESC
");


echo "<table class='table table-dark table-striped' style='font-size: 20px'>
    <thead>
        <tr>
            <th scope='col'>Data</th>
            <th scope='col'>Paciente</th>
            <th scope='col'>Temperatura</th>
            <th scope='col'>Saturação O2</th>
            <th scope='col'>BPM</th>
        </tr> 
    </thead> 
";

echo "<tbody>";

while ($row = mysqli_fetch_array($result)) {

  echo "<tr>";
    $dia = substr($row['data'], -2);
    $mes = substr($row['data'], -5, 2);
    $hora = substr($row['hora'], 0, 2);
  echo "<th scope='row'>". $dia . "/" . $mes. " " . $hora .  "h</th>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['TEMPERATURA'] . "</td>";
  echo "<td>" . $row['O2'] . "</td>";
  echo "<td>" . $row['BPM'] . "</td>";
 
  echo "</tr>";
}
echo "</tbody>
</table>
<br>";
?>