<?php 

require_once "../core/Controller.php";
require_once "../core/Session.php";

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
        Session::start();
    }

    // Show login page
    public function loginPage() {
        $this->view("auth/login");
    }

    // Show registration page
    public function registerPage() {
        $this->view('auth/register');
    }


    // Handle login request
    public function login() {

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars(trim($_POST['username']));
            $password = trim($_POST['password']);

            if (empty($username)) {
                $errors[] = "Username is required";
            }

            if (empty($password)) {
                $errors[] = "Password is required";
            }

            if (empty($errors)) {
            
                $user = $this->userModel->login($username, $password);

                if ($user) {
                 Session::start();
                 Session::set('user_id', $user['id']);
                 Session::set('username', $user['username']);

                    $rolesRaw = $this->userModel->getRoles($user['id']);
                    $roles = array_column($rolesRaw, 'name'); // this is key
                    Session::set('roles', $roles);
                    
                    Session::redirectIfLoggedIn();
                 
                } else {
                    $errors[] = 'Invalid username or password';
                }
            }

            $this->view('auth/login', ['errors' => $errors]);

        } else {
            $this->view('auth/login');
        }
    }

    // Handle register request
    public function register() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars(trim($_POST['username']));
            $email = htmlspecialchars(trim($_POST['email']));
            $password = trim($_POST['password']);
            $confirmPassword = trim($_POST['confirm_password']);

            $errors = [];

            // Validate username
            if (empty($username)) {
                $errors[] = "Username is required";
            } elseif (strlen($username) < 3) {
                $errors[] = "Username must be at least 3 characters.";
            }

            // Validate email
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

            // Confirm password
            if ($password !== $confirmPassword) {
                $errors[] = "Passwords do not match.";
            }

            if (empty($errors)) {
                if ($this->userModel->register($username, $email, $password)) {
                    $userId = $this->userModel->getLastInsertedId();
                    $this->userModel->assignRole($userId, 'admin');
                    header('Location: ' . BASE_URL . '/Auth/loginPage');
                    exit;
                } else {
                    $errors[] = "Registration failed. Please try again.";
                }
            }

            $this->view('auth/register', ['errors' => $errors]);

        } else {
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
