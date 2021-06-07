<?php


include("../../database_connect.php");


if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$result = mysqli_query($con, "select * from users as us
INNER JOIN usersxhistories as ushi
	ON us.idUser = ushi.IdUser
INNER JOIN histories as hi
ON ushi.IdHistory = hi.IdHistory
WHERE (CASE 
       WHEN us.idade < 20 then BPM < 100 OR BPM > 170   
       when us.idade < 40 then BPM < 90 OR BPM > 153 
       when us.idade < 60 then BPM < 80 OR BPM > 136 
       ELSE BPM < 70 OR BPM > 120 
       end)
	ORDER BY BPM DESC LIMIT 5
");


echo "<ul class='list-group'>";
while ($row = mysqli_fetch_array($result)) {
  echo "
  <li class='list-group-item d-flex justify-content-between align-items-start col-sm-12'>

  <img class='col-mb-4' src='https://cdn.pixabay.com/photo/2020/06/30/10/23/icon-5355896_960_720.png'
    alt='' width='30' height='30'>
      <div class='ms-2 me-auto col-mb-8'>
    
      <div class='fw-bold'>".$row['name']."</div>
      Batimento cardíaco
    </div>
    <span class='badge bg-primary rounded-pill col-mb-2'>".$row['BPM']."</span>
    </li>";
    

 
}
echo "</ul>";
echo "<br>";

?>
</div>