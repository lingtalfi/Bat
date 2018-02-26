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

        self::start();

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

    public static function set($k, $v)
    {
        self::start();
        $_SESSION[$k] = $v;
    }


    public static function get($key, $default = null)
    {
        self::start();
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        }
        return $default;
    }


    public static function destroyAll()
    {
        self::start();


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

    public static function dump($keys = null, $removeKeys = null, $useBdot = true)
    {
        self::start();
        $ret = [];

        if (true === $useBdot) {
            if (null === $keys) {
                $ret = $_SESSION;
            } elseif (is_string($keys)) {
                if (BdotTool::hasDotValue($keys, $_SESSION)) {
                    $ret = BdotTool::getDotValue($keys, $_SESSION);
                } else {
                    $ret = null;
                }
            } elseif (is_array($keys)) {
                foreach ($keys as $key) {
                    if (BdotTool::hasDotValue($key, $_SESSION)) {
                        $ret = BdotTool::getDotValue($key, $_SESSION);
                    }
                }
            }
            if (is_array($ret)) {
                if (is_scalar($removeKeys)) {
                    BdotTool::unsetDotValue($removeKeys, $ret);
                } elseif (is_array($removeKeys)) {
                    foreach ($removeKeys as $key) {
                        BdotTool::unsetDotValue($key, $ret);
                    }
                }
            }
        } else {
            if (null === $keys) {
                $ret = $_SESSION;
            } elseif (is_string($keys)) {
                if (array_key_exists($keys, $_SESSION)) {
                    $ret = $_SESSION[$keys];
                } else {
                    $ret = null;
                }
            } elseif (is_array($keys)) {
                foreach ($keys as $key) {
                    if (array_key_exists($key, $_SESSION)) {
                        $ret[$key] = $_SESSION[$key];
                    }
                }
            }
            if (is_array($ret)) {
                if (is_scalar($removeKeys)) {
                    unset($ret[$removeKeys]);
                } elseif (is_array($removeKeys)) {
                    foreach ($removeKeys as $key) {
                        unset($ret[$key]);
                    }
                }
            }
        }
        return $ret;

    }

}