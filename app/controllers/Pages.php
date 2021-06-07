<?php
class Pages extends Controller {
    public function __construct() {
        $this->userModel = $this->model('Page');
    }

    public function index() {
        
        $users_list = $this->userModel->users_list();
        
        $data = [
            'title' => 'Home page',
            'users_list' => $users_list[0],
            'users_count' => $users_list[1],
        ];

        $this->view('index', $data);
    }

    public function simple_table() {
        $this->view('requests/simples_table');
    }

    public function about() {
        $this->view('about');
    }

    public function login()
    {
        $data = [
            'title' => 'Login page',
            'username' => '',
            'password' => '',
            'Error' => ''
        ];


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'Error' => '',
            ];


            if (empty($data['Error'])) {

                $loggedInUser = $this->userModel->login($data['username'], $data['password']);
                
                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['Error'] = 'Usuário ou Senha incorretos.';

                    $this->view('pages/login', $data);
                }
            }
        } else {
            $data = [
                'username' => '',
                'password' => '',
                'Error' => ''
            ];
        }
        $this->view('pages/login', $data);
    }

    public function createUserSession($user)
    {
        $_SESSION['idAccess'] = $user->IdAccess;
        $_SESSION['username'] = $user->username;
        header('location:' . URLROOT . '/index');
    }

    public function logout()
    {
        unset($_SESSION['idAccess']);
        unset($_SESSION['username']);
        header('location:' . URLROOT . '/pages/login');
    }
}
