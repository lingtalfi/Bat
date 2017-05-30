<?php


namespace Bat;


class SessionTool
{


    /**
     * @param $keys , array or string representing the key(s) to destroy from the session.
     *
     *
     * Note: the variables that you did not destroy will survive after a redirection
     *
     * (
     * For instance if you do this:
     *              header("Location: http://your/uri");
     *              exit;
     * )
     */
    public static function destroyPartial($keys)
    {

        if (session_status() === \PHP_SESSION_NONE) {
            session_start();
        }

        if (!is_array($keys)) {
            $keys = [$keys];
        }
        foreach ($_SESSION as $k => $v) {
            if (in_array($k, $keys, true)) {
                unset($_SESSION[$k]);
            }
        }

        $recoveringSession = $_SESSION;
        session_destroy();
        session_start();
        $_SESSION = $recoveringSession;
    }


    public static function start()
    {
        if (session_status() === \PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function destroyAll()
    {
        if (session_status() === \PHP_SESSION_NONE) {
            session_start();
        }
        // http://php.net/manual/en/function.session-destroy.php
        $_SESSION = [];

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (true) {
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
        }
        session_destroy();
    }
}