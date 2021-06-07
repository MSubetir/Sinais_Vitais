<?php


$tempPoints = array();
$maxPoints = array();
$minPoints = array();

foreach ($data as $row) {
  $date = new DateTime($row['date']);
  $date->modify('+1 day');
  $date->modify('-2 hour');
  array_push($tempPoints, array("x" => ($date->getTimestamp() * 1000), "y" => $row['TEMPERATURA']));
}

if(count($data) > 0){
  $date = new DateTime($data[0]['date']);
  $date->modify('+1 day');
  $date->modify('-2 hour');
  array_push($maxPoints, array("x" => $date->getTimestamp() * 1000, "y" => 38));
  array_push($minPoints, array("x" => $date->getTimestamp() * 1000, "y" => 35.5));

  $date = new DateTime($data[count($data) - 1]['date']);
  $date->modify('+1 day');
  $date->modify('-2 hour');
  array_push($maxPoints, array("x" => $date->getTimestamp() * 1000, "y" => 38));
  array_push($minPoints, array("x" => $date->getTimestamp() * 1000, "y" => 35.5));
}

?>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
  var tempchart = new CanvasJS.Chart("temperature", {
    animationEnabled: true,
    axisY: {
      title: "Temperatura",
      suffix: "°",
    },
    data: [{
        type: "spline",
        xValueFormatString: "DD/MMM",
        yValueFormatString: "#°",
        xValueType: "dateTime",
        lineThickness: 3,
        dataPoints: <?php echo json_encode($tempPoints, JSON_NUMERIC_CHECK); ?>,
      },
      {
        type: "line",
        xValueFormatString: "DD/MMM",
        yValueFormatString: "#°",
        xValueType: "dateTime",
        color: "red",
        lineColor: "red",
        lineThickness: 1,
        dataPoints: <?php echo json_encode($maxPoints, JSON_NUMERIC_CHECK); ?>
      },
      {
        type: "line",
        xValueFormatString: "DD/MMM",
        yValueFormatString: "#°",
        xValueType: "dateTime",
        lineColor: "red",
        color: "red",
        lineThickness: 1,
        dataPoints: <?php echo json_encode($minPoints, JSON_NUMERIC_CHECK); ?>
      }
    ]
  });

  tempchart.render();
</script>