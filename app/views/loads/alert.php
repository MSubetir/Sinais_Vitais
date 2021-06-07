

<div class="card card-body">
    <div class="col-md-12 d-flex justify-content-between">
        <h4 class="col-md-6"><i class="material-icons">report</i> Alerta</h4>
        <h3 class="col-md-6 d-flex justify-content-end"><?php $data_sinal = new DateTime($data['alert']->data_sinal);
                                                        echo $data_sinal->format('d M') ?><h3>
    </div>
    <div class="col-md-12 row">
        <div class="col-sm-4">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-1">assignment</i>Sinais Anormais</h6>
                    <ul class="list-group">
                        <?php
                        /*
                        foreach ($data['anormal'] as $row) {
                            echo "<li class='list-group-item d-flex justify-content-center align-items-center col-mb-12'>" . $row->preferredName . "</li>";
                        }
                        */
                        if($data['alert']->temp_desc != 'normal'){
                            echo "<li class='list-group-item d-flex justify-content-center align-items-center col-mb-12'>Temperatura</li>";
                        }
                        if($data['alert']->o2_desc != 'normal'){
                            echo "<li class='list-group-item d-flex justify-content-center align-items-center col-mb-12'>Saturação de O2</li>";
                        }
                        if($data['alert']->bpm_desc != 'normal'){
                            echo "<li class='list-group-item d-flex justify-content-center align-items-center col-mb-12'>Batimentos Cardíacos</li>";
                        }


                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-1">assignment</i>Diagnósticos</h6>
                    <ul class="list-group">
                        <?php
                        foreach ($data['diagnosticos'] as $row) {
                            echo "<li class='text-center list-group-item d-flex justify-content-center align-items-center col-mb-12'>" . $row->preferredName . "</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="p-3 h-100">
                <div class="">
                    <div class="col-md-12 row m-0">
                        <small class="col-md-2 d-flex justify-content-start">35.5º</small>
                        <h7 class="col-md-8 text-center">Temperatura</h7>
                        <small class="col-md-2 d-flex justify-content-end">38º</small>
                    </div>
                    <div class="progress col-md-12" style="height: 5px">
                        <div class="progress-bar bg-primary progress-bar-striped bg-danger" role="progressbar" style="width: <?php echo ((($data['alert']->TEMPERATURA)-35.5)/2.5)*100; ?>%" aria-valuenow="<?php echo ((($data['alert']->TEMPERATURA)-35.5)/2.5)*100; ?>" aria-valuemin="35.5" aria-valuemax="38"></div>
                    </div>
                    <hr>
                    <div class="col-md-12 row m-0">
                        <small class="col-md-2 d-flex justify-content-start">90%</small>
                        <h7 class="col-md-8 text-center">Saturação O2</h7>
                        <small class="col-md-2 d-flex justify-content-end">100%</small>
                    </div>
                    <div class="progress col-md-12" style="height: 5px">
                        <div class="progress-bar bg-primary progress-bar-striped bg-info" role="progressbar" style="width: <?php echo ((($data['alert']->O2)-90)/10)*100; ?>%" aria-valuenow="<?php echo ((($data['alert']->O2)-90)/10)*100; ?>" aria-valuemin="90" aria-valuemax="100"></div>
                    </div>
                    <hr>
                    <div class="col-md-12 row m-0">
                        <small class="col-md-3 d-flex justify-content-start">55 bpm</small>
                        <h7 class="col-md-6 text-center">Batimento p/min</h7>
                        <small class="col-md-3 d-flex justify-content-end">85 bpm</small>
                    </div>
                    <div class="progress col-md-12" style="height: 5px">
                        <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" style="width: <?php echo ((($data['alert']->BPM)-55)/30)*100; ?>%" aria-valuenow="<?php echo ((($data['alert']->BPM)-55)/30)*100; ?>" aria-valuemin="55" aria-valuemax="85"></div>
                    </div>
                    <div class="col-md-12 row p-3 d-flex justify-content-around">
                        <span class='col-md-3 badge bg-danger rounded-pill col-mb-2'><?php echo $data['alert']->TEMPERATURA; ?></span>
                        <span class='col-md-3 badge bg-info rounded-pill col-mb-2'><?php echo $data['alert']->O2; ?></span>
                        <span class='col-md-3 badge bg-primary rounded-pill col-mb-2'><?php echo $data['alert']->BPM; ?></span>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>