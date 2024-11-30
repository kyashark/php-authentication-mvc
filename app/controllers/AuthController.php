<?php 

require_once "../core/Controller.php";
require_once "../core/Session.php";

class AuthController extends Controller{
    private $userModel;

    public function __construct(){
        $this->userModel = $this->model('User');
        Session::start();
    }

     // Redirect if already logged in
     private function redirectIfLoggedIn() {
        if (Session::get('user_id')) {
            if (Session::get('is_admin') == 1) {
                header('Location: ' . BASE_URL . '/admin/dashboard');
            } elseif (Session::get('is_admin') == 0) {
                header('Location: ' . BASE_URL . '/user/home');
            } else {
                // Handle unexpected case
                Session::destroy();
                header('Location: ' . BASE_URL . '/user/index');
            }
            exit;
        }
    }

    // Show login page
    public function loginPage(){
        $this->redirectIfLoggedIn();
        $this->view("auth/login");
    }

    // Handle login request
    public function login(){

        $this->redirectIfLoggedIn();
       
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $username = htmlspecialchars(trim($_POST['username']));
            $password = trim($_POST['password']);
        

        $errors = [];

        if(empty($username)){
            $errors[] = "Username is required";
        }

        if(empty($password)){
            $errors[] = "Password is required";
        }

        if(empty($errors)){

            // Attempt login
            $user = $this->userModel->login($username, $password);

            if($user){
                // Successful login
                Session::set('user_id', $user['id']);
                Session::set('username', $user['username']);
                Session::set('is_admin', $user['is_admin']);
                
                $this->redirectIfLoggedIn();

            }else{
                // Invalid credentials
                $errors[] = 'Invalid username or password';
            }
        }

        if (!empty($errors)) {
            $this->view('auth/login', ['errors' => $errors]);
        }

    } else {
        $this->view('auth/login');
    }
}


    // Show registretion page
    public function registerPage(){
        $this->redirectIfLoggedIn();
        $this->view('auth/register');
    }

    // Handle register request()
    public function register(){

        $this->redirectIfLoggedIn();


        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $username = htmlspecialchars(trim($_POST['username']));
            $email = htmlspecialchars(trim($_POST['email']));
            $password = trim($_POST['password']);
            $confirmPassword = trim($_POST['confirm_password']);

            $errors= [];

            // Validate username
            if (empty($username)) {
                $errors[] = "Username is required";
            } elseif (strlen($username) < 3) {
                $errors[] = "Username must be at least 3 characters.";
            }

            // Validate Email
            if (empty($email)) {
                $errors[] = "Email is required";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email address.";
            } elseif ($this->userModel->emailExists($email)) {
                $errors[] = "This email is already in use.";
            }

            // Validate password
            if (empty($password)) {
                $errors[] = "Password is required.";
            } elseif (strlen($password) < 6) {
                $errors[] = "Password must be at least 6 characters long.";
            } elseif (!preg_match("/[A-Z]/", $password)) {
                $errors[] = "Password must contain at least one uppercase letter.";
            } elseif (!preg_match("/[0-9]/", $password)) {
                $errors[] = "Password must contain at least one number.";
            }

            // Check confirm password
            if($password !== $confirmPassword){
                $errors[]="Passwords do not match";
            }


            if(empty($errors)){
                if($this->userModel->register($username,$email,$password)){
                    header('Location: ' . BASE_URL . '/Auth/loginPage');
                }else{
                    $errors[] = "Registration failed. Please try again.";
                }
            }

            $this->view('auth/register', ['errors' => $errors]);

        }else{
            $this->view('auth/register');
        }
    }


     // Logout user
     public function logout() {
        Session::destroy();
        header('Location: ' . BASE_URL . '/user/index');
        exit;
    }
}