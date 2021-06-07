<?php
class Loads extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('Load');
    }

    public function simple_table()
    {
        $simple = $this->userModel->simple_table();
        $this->view('loads/simple_table', $simple);
    }

    public function user_table()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => trim($_GET['user_id']),
                'dias' => trim($_GET['dias'])
            ];

            $user_data = $this->userModel->user_table($data['user_id'], $data['dias']);
            $this->view('loads/simple_table', $user_data);
        }
    }

    public function highlights()
    {
        $high = [];
        $high = $this->userModel->highlights();
        $newData = [];
        foreach ($high as $row) {
            if($row['o2_desc'] != 'normal' || $row['bpm_desc'] != 'normal' || $row['temp_desc'] != 'normal'){
                $row['danger_level'] = 2;
    
                if($row['diagnosticos_numero'] > 0){
                    $row['danger_level'] = 3;
                }
            }else{
                $row['danger_level'] = 1;
            }
            array_push($newData, $row);
        }
    
        $this->view('loads/highlights', $newData);
    }

    public function alert()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

            $history_id = "";
            if (isset($_GET['history_id']) == true) {
                $history_id = trim($_GET['history_id']);
            }

            $data = [
                'user_id' => trim($_GET['user_id'])
            ];

            $alert = $this->userModel->user_alert($data['user_id']);
            if ($alert) {
                
                $texto =
                    $alert->temp_desc . " temperature. " .
                    $alert->bpm_desc . " pulse. "
                    . "Patient oxygen " . $alert->o2_desc . ". " .
                    $alert->descricao;
                
                /*
                high temperature is greater than 50. low temperature is less than 30.
                high pulse is greater than 120. low pulse is less than 60.
                low oxygen is less than 90.
                */
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://us-south.wh-acd.cloud.ibm.com/wh-acd/api/v1/analyze/wh_acd.ibm_clinical_insights_v1.0_standard_flow?version=2020-03-31');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_USERPWD, 'apikey:EvzzUeuSccKI0ePUmSlsN8vi8fwWIIfoTnIAzyXiW2hB');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $texto);

                $headers = array();
                $headers[] = 'Accept: application/json';
                $headers[] = 'Content-Type: text/plain';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo 'Erro na IA:' . curl_error($ch);
                }
                curl_close($ch);

                $newData = json_decode($result);
                $dados = $newData->unstructured[0]->data->attributeValues;

                $anormal = [];
                $diagnosticos = [];

                #---------------------------

                $headers =  array(
                    "Content-type: application/json",
                    "Authorization: Basic ". base64_encode("2088-rwrmTT2F:ODcZwGyrCRR8+eEM1QIUB/j0rIjvqt4Q")
                );

                
                foreach ($dados as $row) {
                    if ($row->name == "AbnormalFinding" || $row->name == "Diagnosis") {
                        $data_array = array();
                        $data_array ["SL"] = "EnUs";
                        $data_array ["TL"] = "PtBr";
                        $data_array ["T"] = $row->preferredName;
                        $data = json_encode($data_array );
                    
                        $options = array (
                            'http' => array (
                                'header' => $headers,
                                'method' => 'POST',
                                'content' => $data
                            )
                        );

                        $context  = stream_context_create($options);
                        $result = file_get_contents('https://api.gotit.ai/Translation/v1.1/Translate', false, $context);
                        $result = json_decode($result, true);

                        $row->preferredName = $result['result'];

                        if ($row->name == "AbnormalFinding") {
                            array_push($anormal, $row);
                            
                        } else if ($row->name == "Diagnosis") {
                            array_push($diagnosticos, $row);
                        }
                    }
                }

                $data = [
                    'alert' => $alert,
                    'anormal' => $anormal,
                    'diagnosticos' => $diagnosticos
                ];


                $this->view('loads/alert', $data);
            }
        }
    }

    public function temperature_graph()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => trim($_GET['user_id']),
                'dias' => trim($_GET['dias'])
            ];

            if (empty($data['dias'])) {
                $data['dias'] = '7';
            }

            $graph = $this->userModel->graph_data($data['user_id'], $data['dias']);
            $this->view('loads/graphs/temperature', $graph);
        }
    }

    public function bpm_graph()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => trim($_GET['user_id']),
                'dias' => trim($_GET['dias'])
            ];

            if (empty($data['dias'])) {
                $data['dias'] = '7';
            }

            $graph = $this->userModel->graph_data($data['user_id'], $data['dias']);
            $this->view('loads/graphs/bpm', $graph);
        }
    }

    public function o2_graph()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => trim($_GET['user_id']),
                'dias' => trim($_GET['dias'])
            ];

            if (empty($data['dias'])) {
                $data['dias'] = '7';
            }

            $graph = $this->userModel->graph_data($data['user_id'], $data['dias']);
            $this->view('loads/graphs/o2', $graph);
        }
    }
}
