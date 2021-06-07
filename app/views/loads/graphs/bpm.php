<?php

$bpmPoints = array();
$maxPoints = array();
$minPoints = array();

foreach ($data as $row) {
  $date = new DateTime($row['date']);
  $date->modify('+1 day');
  $date->modify('-2 hour');
  array_push($bpmPoints, array("x" => $date->getTimestamp() * 1000, "y" => $row['BPM']));
}

if(count($data) > 0){
  $date = new DateTime($data[0]['date']);
  $date->modify('+1 day');
  $date->modify('-2 hour');
  array_push($maxPoints, array("x" => $date->getTimestamp() * 1000, "y" => 85));
  array_push($minPoints, array("x" => $date->getTimestamp() * 1000, "y" => 55));
  
  $date = new DateTime($data[count($data)-1]['date']);
  $date->modify('+1 day');
  $date->modify('-2 hour');
  array_push($maxPoints, array("x" => $date->getTimestamp() * 1000, "y" => 85));
  array_push($minPoints, array("x" => $date->getTimestamp() * 1000, "y" => 55));
}


?>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
  var bpmchart = new CanvasJS.Chart("bpm", {
    animationEnabled: true,
    axisY: {
      title: "Batidas por minuto",
      suffix: " bpm",
    },
    data: [{
      type: "spline",
      xValueFormatString: "DD/MMM",
      yValueFormatString: "# bpm",
      xValueType: "dateTime",
      lineThickness: 3,
      dataPoints: <?php echo json_encode($bpmPoints, JSON_NUMERIC_CHECK); ?>
    },
    {
      type: "line",
      xValueFormatString: "DD/MMM",
      yValueFormatString: "# bpm",
      xValueType: "dateTime",
      color: "red",
      lineColor: "red",
      lineThickness: 1,
      dataPoints: <?php echo json_encode($maxPoints, JSON_NUMERIC_CHECK); ?>
    },
    {
      type: "line",
      xValueFormatString: "DD/MMM",
      yValueFormatString: "# bpm",
      xValueType: "dateTime",
      lineColor: "red",
      color: "red",
      lineThickness: 1,
      dataPoints: <?php echo json_encode($minPoints, JSON_NUMERIC_CHECK); ?>
    }]
  });
  bpmchart.render();
</script>