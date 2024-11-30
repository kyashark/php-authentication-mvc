<?php 

require_once "../core/Controller.php";
require_once "../core/Session.php";

class AdminController extends Controller {
    public function dashboard() {
        Session::start();
        $username = Session::get('username');
        $this->view('admin/dashboard', ['username' => $username]);
    }
}