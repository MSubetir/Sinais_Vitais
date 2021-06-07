<?php 

include("../../database_connect.php");

$tempPoints = array();
$bpmPoints = array();
$o2Points = array();

$result = mysqli_query($con, "SELECT 
DATE(date) as date,
COUNT(DATE(date)),
BPM,
TEMPERATURA,
O2
FROM
histories as hi
INNER JOIN usersxhistories as ushi
ON hi.IdHistory = ushi.IdHistory
WHERE ushi.IdUser = $user_id
GROUP BY DATE(date)
HAVING COUNT(DATE(date)) = 1


UNION

SELECT 
DATE(date) as date,
COUNT(DATE(date)),
avg(BPM) as BPM,
avg(TEMPERATURA) as TEMPERATURA,
avg(O2) as O2
FROM
histories as hi
INNER JOIN usersxhistories as ushi
ON hi.IdHistory = ushi.IdHistory
WHERE ushi.IdUser = $user_id
GROUP BY DATE(date)
HAVING COUNT(DATE(date)) > 1

ORDER BY DATE(date)");

while ($row = mysqli_fetch_array($result)) {
  $date = new DateTime($row['date']);
  array_push($tempPoints, array("x" => $date->getTimestamp()*1000, "y" => $row['TEMPERATURA']));
  array_push($bpmPoints, array("x" => $date->getTimestamp()*1000, "y" => $row['BPM']));
  array_push($o2Points, array("x" => $date->getTimestamp()*1000, "y" => $row['O2']));
}

?>

