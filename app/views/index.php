<?php
require APPROOT . '/views/includes/head.php';
?>

<html>

<head>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/libraries/leaflet/leaflet.css" />
    <script src="<?php echo URLROOT ?>/public/libraries/leaflet/leaflet.js"></script>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>

<?php
require APPROOT . '/views/includes/navigation.php';
#ufsc123456
#@_Ufsc123456
?>

<body>
    <div class="container">
        <div class="col-sm-12 mt-3">
            <div class="row">
                <div class="col-sm-8">
                    <div class="card card-body">
                        <h4><i class="material-icons">room</i> Mapa de Pacientes</h4>
                        <div id="mapid"></div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card card-body mb-3">
                        <h4><i class="material-icons">report</i> Atenção</h4>
                        <div id="highlights"></div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 d-flex justify-content-center align-items-center mb-2">
                <h3 class="col-sm-4 text-center text-primary">Gráficos Semanais</h3>
                <h4 class="col-sm-4 card text-center text-secondary font-monospace  mb-0" id="graphFilter"></h4>
                <div class="col-sm-4 form-check form-switch d-flex justify-content-center ">
                    <input class="form-check-input" style="margin-right:10px" type="checkbox" id="flexSwitchCheck" checked />
                    <h5 class="form-check-label mb-0 text-primary" id="flexSwitchText" for="flexSwitchCheck">Automático</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="card card-body">
                        <h6 class="text-center">Temperatura</h6>
                        <div id="temperature" style="height: 250px; width: 100%;"></div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card card-body">
                        <h6 class="text-center">Batimento cardíaco</h6>
                        <div id="bpm" style="height: 250px; width: 100%;"></div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card card-body">
                        <h6 class="text-center">Saturação de O2</h6>
                        <div id="o2" style="height: 250px; width: 100%;"></div>
                    </div>
                </div>
            </div>


        </div>

        <div class="col-sm-12">
            <div class="card card-body">
                <h4><i class="material-icons">table_view</i> Tabela Simples</h4>
                <div id="simple_table"></div>
            </div>
        </div>

    </div>
</body>

</html>

<script>
    // ------ Switch

    document.getElementById("flexSwitchCheck").addEventListener("change", setId);

    function setId() {
        if (x = document.getElementById("flexSwitchCheck").checked) {
            idInterval = setInterval(updateData, 10000)
            element = document.getElementById("flexSwitchText")
            element.className = element.className.replace(/\btext-secondary\b/g, "text-primary");
        } else {
            clearInterval(idInterval)
            element = document.getElementById("flexSwitchText")
            element.className = element.className.replace(/\btext-primary\b/g, "text-secondary");
        }
    }

    // ------ Gráficos

    var users = [];
    var idInterval;

    <?php
    foreach ($data['users_list'] as $row) {
    ?>
        users.push(['<?php echo $row['IdUser']; ?>', '<?php echo $row['name']; ?>']);

    <?php
    }
    ?>


    var index = 1;
    var max = <?php echo $data['users_count']; ?>;

    let id = users[index - 1][0];
    let name = users[index - 1][1];

    var $simple_table = $("#simple_table");
    var $highlights = $("#highlights");
    var $temp_graph = $("#temperature");
    var $bpm_graph = $("#bpm");
    var $o2_graph = $("#o2");

    $simple_table.load("<?php echo URLROOT; ?>/loads/simple_table");
    $highlights.load("<?php echo URLROOT; ?>/loads/highlights");
    $temp_graph.load(`<?php echo URLROOT; ?>/loads/temperature_graph?user_id=${index}`);
    $bpm_graph.load(`<?php echo URLROOT; ?>/loads/bpm_graph?user_id=${index}`);
    $o2_graph.load(`<?php echo URLROOT; ?>/loads/o2_graph?user_id=${index}`);

    document.getElementById("graphFilter").innerHTML = users[index - 1][1];
    console.log(users)

    function updateData() {
        index == max ? index = 1 : index++;

        id = users[index - 1][0];
        name = users[index - 1][1];

        $simple_table.load("<?php echo URLROOT; ?>/loads/simple_table");
        $highlights.load("<?php echo URLROOT; ?>/loads/highlights");
        $temp_graph.load(`<?php echo URLROOT; ?>/loads/temperature_graph?user_id=${id}`);
        $bpm_graph.load(`<?php echo URLROOT; ?>/loads/bpm_graph?user_id=${id}`);
        $o2_graph.load(`<?php echo URLROOT; ?>/loads/o2_graph?user_id=${id}`);

        document.getElementById("graphFilter").innerHTML = name;
    }

    idInterval = setInterval(updateData, 7500);

    // ------ Mapa

    var mymap = L.map('mapid').setView([-27.5969, -48.5495], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: '',
        maxZoom: 18,
        id: 'mapbox/dark-v10',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoibWF5Y29uc3ViZXRpciIsImEiOiJja211a3NtNDExMmN0MnBwZjZtZ29xZzh3In0.aK1vJJkBxgZX4G9iOp_nIg'
    }).addTo(mymap);

    <?php
    foreach ($data['users_list'] as $row) {
    ?>
        var x = L.icon({
            iconUrl: 'https://cdn.pixabay.com/photo/2020/06/30/10/23/icon-5355896_960_720.png',
            iconSize: [30, 30], // size of the icon
            shadowSize: [50, 50], // size of the shadow
            iconAnchor: [15, 15], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62], // the same for the shadow
            popupAnchor: [-1, -15] // point from which the popup should open relative to the iconAnchor
        });

        L.marker([<?php echo $row['lat'] ?>, <?php echo $row['lon'] ?>], {
            icon: x
        }).addTo(mymap).bindPopup("<?php echo $row['name'] ?>").on('click', function() { setTimeout(()=>{window.location.href = "<?php echo URLROOT ."/users/details?user_id=".$row['IdUser']; ?>";}, 2000); });
    <?php
    }
    ?>
</script>