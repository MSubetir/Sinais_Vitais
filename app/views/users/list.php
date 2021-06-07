<?php
require APPROOT . '/views/includes/head.php';
?>

<html>

<?php
require APPROOT . '/views/includes/navigation.php';
?>

<body>
  <div class="container mt-2">
    <div class="card col-md-12 py-2 px-4">

      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a class="text-decoration-none" href="<?php echo URLROOT; ?>/index">Início</a></li>
          <li class="breadcrumb-item active" aria-current="page">Usuários</li>
        </ol>
      </nav>


    </div>
    <div class="col-sm-12 d-flex justify-content-end p-2">
      <a href="<?php echo URLROOT; ?>/users/register"><button type="submit" class="btn btn-primary">Novo usuário</button></a>
    </div>



    <div class="col-sm-12">
      <div class="card card-body">

        <div id="Users_table">
          <table class='table ' style='font-size: 20px'>
            <thead>
              <tr>
                <th scope='col'>Código</th>
                <th scope='col'>Paciente</th>
                <th scope='col'>Idade</th>
                <th scope='col'>Editar</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($data as $row) {
                echo "<tr>";
                echo "<th scope='row'>" . $row['IdUser']  .  "</th>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['idade'] . "</td>";
                echo "<td>
                <a href='". URLROOT ."/users/details?user_id=".$row['IdUser']."'>
                  <i class='material-icons text-primary'>visibility</i>
                </a>
                </td>";
                echo "</tr>";
              }
              ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>


  </div>
</body>

</html>