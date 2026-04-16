<?php 
class Model_Core_Session {
    public static function get_session_id() {
        return session_id();
    }

    public function setSession($key, $value) {
        $_SESSION[$key] = $value;
        return $this;
    }

    public function getSession($key) {
        return $_SESSION[$key] ?? null;
    }

    public function removeSession($key) {
        unset($_SESSION[$key]);
    }

    public function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function destroySession() {
        session_destroy();
    }
}
?>