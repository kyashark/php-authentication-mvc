<?php
require_once "../core/Controller.php";
require_once "../core/Session.php";

class AdminController extends Controller {
    
public function dashboard() {
    Session::requireLogin(); // ✅ check login

    if (!Session::hasRole('admin')) {
        header('Location: ' . BASE_URL . '/unauthorized');
        exit;
    }

    $username = Session::get('username');
        $this->view('admin/dashboard', ['username' => $username]);
}
}
