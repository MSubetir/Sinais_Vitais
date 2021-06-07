<?php

$o2Points = array();
$maxPoints = array();
$minPoints = array();

foreach ($data as $row) {
  $date = new DateTime($row['date']);
  $date->modify('+1 day');
  $date->modify('-2 hour');
  array_push($o2Points, array("x" => $date->getTimestamp() * 1000, "y" => $row['O2']));
}

if(count($data) > 0){
  $date = new DateTime($data[0]['date']);
  $date->modify('+1 day');
  $date->modify('-2 hour');
  array_push($maxPoints, array("x" => $date->getTimestamp() * 1000, "y" => 100));
  array_push($minPoints, array("x" => $date->getTimestamp() * 1000, "y" => 90));

  $date = new DateTime($data[count($data)-1]['date']);
  $date->modify('+1 day');
  $date->modify('-2 hour');
  array_push($maxPoints, array("x" => $date->getTimestamp() * 1000, "y" => 100));
  array_push($minPoints, array("x" => $date->getTimestamp() * 1000, "y" => 90));
}
?>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
  var o2chart = new CanvasJS.Chart("o2", {
    animationEnabled: true,
    axisY: {
      title: "Porcentagem",
      suffix: "%",
    },
    data: [{
      type: "spline",
      xValueFormatString: "DD/MMM",
      xValueType: "dateTime",
      lineThickness: 3,
      dataPoints: <?php echo json_encode($o2Points, JSON_NUMERIC_CHECK); ?>
    },
    {
      type: "line",
      xValueFormatString: "DD/MMM",
      xValueType: "dateTime",
      color: "red",
      lineColor: "red",
      lineThickness: 1,
      dataPoints: <?php echo json_encode($maxPoints, JSON_NUMERIC_CHECK); ?>
    },
    {
      type: "line",
      xValueFormatString: "DD/MMM",
      xValueType: "dateTime",
      lineColor: "red",
      color: "red",
      lineThickness: 1,
      dataPoints: <?php echo json_encode($minPoints, JSON_NUMERIC_CHECK); ?>
    }]
  });
  o2chart.render();
</script>