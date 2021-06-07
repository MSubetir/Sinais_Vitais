<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index($current, $params)
    {
        $data = [
            'title' => 'Home page'
        ];
        echo $current, $params;
        $this->view($current, $params);
    }

    public function register()
    {
        $data = [
            'erro' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'nascimento' => trim($_POST['nascimento']),
                'email' => trim($_POST['email']),
                'telefone' => trim($_POST['telefone']),
                'rua' => trim($_POST['rua']),
                'numero' => trim($_POST['numero']),
                'cidade' => trim($_POST['cidade']),
                'estado' => trim($_POST['estado']),
                'cep' => str_replace('.', '', trim($_POST['cep'])),
                'erro' => ''
            ];

            $now = new DateTime();
            $date = new DateTime($data['nascimento']);
            $interval = $now->diff($date);
            $data['idade'] = $interval->format("%y");

            #$urlbase = "http://nominatim.openstreetmap.org/?format=json&addressdetails=1&q=itapema&format=json&limit=1";
            #&urlbase2 = "https://nominatim.openstreetmap.org/?format=json&addressdetails=1&street=330/810&city=itapema&state=santa catarina&postalcode=88220-000&format=json&limit=1"
            $opts = array('http' => array('header' => "User-Agent: StevesCleverAddressScript 3.7.6\r\n"));
            $context = stream_context_create($opts);

            $url = 'https://nominatim.openstreetmap.org/?format=json&addressdetails=1&street=' . $data['numero'] . '/' . $data['rua'] . '&city=' . $data['cidade'] . '&state=' . $data['estado'] . '&format=json&limit=1';
            
            $resp_json = file_get_contents($url, false, $context);
            $resp = json_decode($resp_json, true);
        
            
            if (isset($resp[0]['lat']) == false || isset($resp[0]['lon']) == false) {
                $url = 'https://nominatim.openstreetmap.org/?format=json&addressdetails=1&postalcode=' . $data['cep'] . '&format=json&limit=1';
                $resp_json = file_get_contents($url, false, $context);
                $resp = json_decode($resp_json, true);

                if (isset($resp[0]['lat']) == false || isset($resp[0]['lon']) == false) {
                    $data['erro'] = 'endereço não encontrado.';
                }
            }
     
           
            if (empty($data['erro'])) {
                $data['lat'] = $resp[0]['lat'];
                $data['lon'] = $resp[0]['lon'];

                if ($this->userModel->register($data)) {
                    header('location:' . URLROOT . '/users/list');
                } else {
                    die("Erro no sistema.");
                }
            }

            $this->view('users/register', $data);
        }

        $this->view('users/register', $data);
    }


    public function details()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => trim($_GET['user_id'])
            ];

            $user = $this->userModel->one_user($data['user_id']);
           
            $data['user'] = $user;
            $this->view('users/details', $data);
        }
    }

    public function list()
    {
        $data = $this->userModel->users_list();
        $newData = [];
        $now = new DateTime();
        foreach ($data as $row) {
            $date = new DateTime($row['nascimento']);
            $interval = $now->diff($date);
            $row['idade'] = $interval->format("%y");
            array_push($newData, $row);
        }

        $this->view('users/list', $newData);
    }
}
