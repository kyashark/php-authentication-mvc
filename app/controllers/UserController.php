<?php 

require_once "../core/Controller.php";
require_once "../core/Session.php";

class UserController extends Controller {

    public function home() {
        Session::start();
        $username = Session::get('username');
        $this->view('user/home', ['username' => $username]);
    }

    
    public function index() {
        Session::redirectIfLoggedIn();
        $this->view('index');
    }
}

