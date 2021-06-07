<?php

include("../../database_connect.php");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con, "select * from users");


echo "<table class='table ' style='font-size: 20px'>
    <thead>
        <tr>
            <th scope='col'>Código</th>
            <th scope='col'>Paciente</th>
            <th scope='col'>Idade</th>
            <th scope='col'>Editar</th>
        </tr> 
    </thead> 
";

echo "<tbody>";

while ($row = mysqli_fetch_array($result)) {

  echo "<tr>";
  echo "<th scope='row'>". $row['IdUser']  .  "</th>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['idade'] . "</td>";
  echo "<td></td>";

 
  echo "</tr>";
}
echo "</tbody>
</table>";
?>