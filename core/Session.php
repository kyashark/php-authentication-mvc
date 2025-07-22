<?php
class Session {
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function destroy() {
        if (session_status() === PHP_SESSION_ACTIVE) {
        // Unset all session variables
        $_SESSION = [];

        // Delete session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Destroy the session
        session_destroy();
    }
    }

    // Check if user has a single role
    public static function hasRole($role) {
        return in_array($role, $_SESSION['roles'] ?? []);
    }

    // Check if user has any of the given roles
    public static function hasAnyRole(array $roles) {
        return count(array_intersect($roles, $_SESSION['roles'] ?? [])) > 0;
    }

    // Require a specific role or redirect
    public static function requireRole($role) {
        self::start();
        if (!self::hasRole($role)) {
            header("Location: " . BASE_URL . "/unauthorized");
            exit;
        }
    }

    // Require any of the roles or redirect
    public static function requireAnyRole(array $roles) {
        self::start();
        if (!self::hasAnyRole($roles)) {
            header("Location: " . BASE_URL . "/unauthorized");
            exit;
        }
    }

    public static function redirectIfLoggedIn() {
    self::start();

    if (self::get('user_id')) {
        $roles = self::get('roles') ?? [];

        if (in_array('admin', $roles)) {
            header('Location: ' . BASE_URL . '/admin/dashboard');
            exit;
        } elseif (in_array('editor', $roles)) {
            header('Location: ' . BASE_URL . '/user/home');
            exit;
        } elseif (in_array('user', $roles)) {
            header('Location: ' . BASE_URL . '/user/home');
            exit;
        } else {
            self::destroy();
            header('Location: ' . BASE_URL . '/unauthorized');
            exit;
        }
    }
}

public static function requireLogin() {
    self::start();
    if (!self::get('user_id')) {
        header('Location: ' . BASE_URL . '/');
        exit;
    }
}

}
