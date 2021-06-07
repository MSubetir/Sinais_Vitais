<ul class='list-group'>
  <?php
  foreach ($data as $row) {
    $cuts = explode(" ", $row['name']);
    echo "
          <li class='";
          if($row['danger_level'] == 2){
            echo "border border-warning ";
          }else if($row['danger_level'] == 3){
            echo "border border-danger ";
          };
          echo "list-group-item d-flex justify-content-between align-items-start col-mb-12'>

          <div class='col-mb-6'>
            <div class='col-mb-4 d-flex'>
              <img class='col-mb-2 ' src='https://cdn.pixabay.com/photo/2020/06/30/10/23/icon-5355896_960_720.png' alt='' width='30' height='30'>
              
              <a class='text-decoration-none' href='". URLROOT ."/users/details?user_id=".$row['IdUser']."'><div class='fw-bold px-1'>" . $cuts[0] . "</div></a>
              ";
               
            echo "</div>
            ";

            if($row['diagnosticos_numero'] > 0){
              echo "<span class='mt-2 mx-1 badge bg-secondary rounded-pill col-mb-2'>".$row['diagnosticos_numero']." Diagnósticos</span>";
              echo "<span class='mt-2 mx-1 badge bg-danger rounded-pill col-mb-2'>Perigo</span>";
            }else{
              echo "<span class='mt-2 mx-1 badge bg-warning rounded-pill col-mb-2'>Alerta</span>";
            }


            
          echo "</div>
          
          <div class='col-mb-6'>
            
            ";
          if($row['temp_desc'] != 'normal'){
            echo "<div class='d-flex justify-content-center align-items-center'>
              <i class='material-icons'>thermostat</i>
                <span class='badge bg-warning rounded-pill col-mb-2'> " . $row['TEMPERATURA'] . "</span>
            </div>";
          }
          
          
          if($row['o2_desc'] != 'normal'){
            echo "<div class='d-flex justify-content-center align-items-center'>
            <i class='material-icons'>favorite_border</i>
              <span class='badge bg-warning rounded-pill col-mb-2'> " . $row['BPM'] . "</span>
          </div>";
          }
          
          
          if($row['bpm_desc'] != 'normal'){
            echo "<div class='d-flex justify-content-center align-items-center'>
            <i class='material-icons'>air</i>
              <span class='badge bg-warning rounded-pill col-mb-2'> " . $row['O2'] . "</span>
          </div>";
          }
            
            
           echo "</div>
           </li>";
  }
  ?>
</ul>
<br>
</div>