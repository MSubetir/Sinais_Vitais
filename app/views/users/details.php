<?php
require APPROOT . '/views/includes/head.php';
?>

<html>

<head>
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/users/datails.css" />

  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>

<style>
  .loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite;
    /* Safari */
    animation: spin 2s linear infinite;
    margin-bottom: 50px;
  }

  /* Safari */
  @-webkit-keyframes spin {
    0% {
      -webkit-transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(360deg);
    }
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }
</style>

<?php
require APPROOT . '/views/includes/navigation.php';
?>

<body>
  <div class="container mt-2">
    <div class="card col-md-12 py-2 px-4">

      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a class="text-decoration-none " href="<?php echo URLROOT; ?>/index">Início</a></li>
          <li class="breadcrumb-item"><a class="text-decoration-none" href="<?php echo URLROOT; ?>/users/list">Usuários</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo ($data['user']->name); ?></li>
        </ol>
      </nav>


    </div>
    <div class="card col-md-12">
      <div class="row">
        <div class="col-md-4 d-flex align-items-center justify-content-center">
          <div class="d-flex flex-column align-items-center text-center">
            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
            <div class="mt-3">
              <h4><?php echo ($data['user']->name); ?> </h4>
              <p class="text-muted font-size-sm"><?php echo ($data['user']->cidade . ", " . $data['user']->estado); ?></p>

            </div>
          </div>
        </div>

        <div class="col-md-8 p-3">
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Nome Completo</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <?php echo ($data['user']->name); ?>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Data de nascimento</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <?php $date = new DateTime($data['user']->nascimento);
              echo $date->format('d-m-Y'); ?>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Email</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <?php echo ($data['user']->email); ?>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Telefone</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <?php echo ($data['user']->telefone); ?>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Endereço</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              (<?php echo ($data['user']->cep); ?>)
              <?php echo ("Rua " . $data['user']->rua . ", Nº " . $data['user']->numero); ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12 d-flex justify-content-center">
      <div class="loader" id='loader'></div>
    </div>
    <div class="col-md-12">
      <div id='alert'></div>
    </div>

    <div class="col-sm-12 row">
      <div class="col-sm-9">
        <div class="col-sm-12">
          <div class="card card-body">
            <h4><i class="material-icons">bar_chart</i> Gráfico</h4>
            <div class="graph" style="height: 250px; width: 100%;"></div>
          </div>
        </div>

        <div class="col-sm-12">
          <div class="card card-body">
            <h4><i class="material-icons">table_view</i> Tabela Simples</h4>
            <div id="table"></div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="col-sm-12">
          <div class="card card-body">
            <h4 class="text-center mb-0">SINAIS</h4>
            <hr>
            <div class="card ">
              <button type="submit" id="tempButton" class="btn btn-primary">Temperatura</button>
            </div>

            <div class="card">
              <button type="submit" id="bpmButton" class="btn btn-primary">BPM</button>
            </div>

            <div class="card">
              <button type="submit" id="o2Button" class="btn btn-primary">Oxigênio</button>
            </div>

            <h4 class="text-center mb-0">DATAS</h4>
            <hr>
            <div class="card ">
              <button type="submit" id="dias_7" class="btn btn-primary">7 dias</button>
            </div>

            <div class="card">
              <button type="submit" id="dias_30" class="btn btn-primary">30 dias</button>
            </div>

            <div class="card">
              <button type="submit" id="dias_year" class="btn btn-primary">1 ano</button>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
  </div>

</body>

</html>

<script>
  var $table = $("#table");
  var $alert = $("#alert");
  var $graph = $(".graph");

  var graphType = 'temperature';
  var dias = '30'
  var element = document.getElementsByClassName("graph")[0];

  function update(graphType, dias) {
    element.setAttribute("id", graphType)
    $graph.load(`<?php echo URLROOT; ?>/loads/${graphType}_graph?user_id=<?php echo ($data['user']->IdUser); ?>&dias=${dias}`);
    $table.load(`<?php echo URLROOT; ?>/loads/user_table?user_id=<?php echo ($data['user']->IdUser); ?>&dias=${dias}`);
  }
  update(graphType, dias);

  document.getElementById("tempButton").addEventListener("click", () => {
    graphType = 'temperature';
    update(graphType, dias);
  });

  document.getElementById("bpmButton").addEventListener("click", () => {
    graphType = 'bpm';
    update(graphType, dias);
  });

  document.getElementById("o2Button").addEventListener("click", () => {
    graphType = 'o2';
    update(graphType, dias);
  });

  document.getElementById("dias_7").addEventListener("click", () => {
    dias = '7'
    update(graphType, dias);
  });

  document.getElementById("dias_30").addEventListener("click", () => {
    dias = '30'
    update(graphType, dias);
  });

  document.getElementById("dias_year").addEventListener("click", () => {
    dias = '365'
    update(graphType, dias);
  });

  $alert.load(`<?php echo URLROOT; ?>/loads/alert?user_id=<?php echo ($data['user']->IdUser); ?>`, () => {
    document.getElementById("loader").classList.remove('loader');
  });
</script>