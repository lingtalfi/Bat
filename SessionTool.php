<?php


namespace Ling\Bat;


use Ling\Bat\Exception\BatException;

/**
 * The SessionTool class.
 */
class SessionTool
{


    private static $flagName = 'ling.bat.flags';


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

    public static function remove($k)
    {
        self::start();
        unset($_SESSION[$k]);
    }


    /**
     * Returns the value referenced by the given key from the session.
     * If it's not found, either:
     * - the default value is returned (by default)
     * - an exception is thrown (only if throwEx=true)
     *
     *
     *
     * @param string $key
     * @param null $default
     * @param bool $throwEx
     * @return mixed
     * @throws \Exception
     */
    public static function get(string $key, $default = null, bool $throwEx = false)
    {
        self::start();
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        }
        if (true === $throwEx) {
            throw new BatException("Value \"$key\" not found in the session.");
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




    //--------------------------------------------
    // FLAGS
    //--------------------------------------------
    /**
     * The flags mechanism:
     * you set up a flag with setFlag, then when you retrieve it with pickupFlag
     * it removes it (i.e. you can only retrieve it once until it's set again).
     *
     * This behaviour was handy in the following case (there might be other usecases):
     *
     * - an insert form that redirects upon the update page on success.
     *          Problem, on the redirected page we don't have the success notification that the user expects.
     *          With flags, we set a flag before redirection, then on landing page we retrieve it to see
     *          whether or not we show the alert.
     *
     */
    //--------------------------------------------
    public static function setFlag($identifier, $value = true)
    {
        self::start();
        if (!array_key_exists(self::$flagName, $_SESSION)) {
            $_SESSION[self::$flagName] = [];
        }
        $flags = $_SESSION[self::$flagName];
        $flags[$identifier] = $value;
        $_SESSION[self::$flagName] = $flags;
    }

    public static function pickupFlag($identifier)
    {
        self::start();
        if (!array_key_exists(self::$flagName, $_SESSION)) {
            $_SESSION[self::$flagName] = [];
        }

        $flags = $_SESSION[self::$flagName];
        if (array_key_exists($identifier, $flags)) {
            $ret = $flags[$identifier];
            unset($flags[$identifier]);
            $_SESSION[self::$flagName] = $flags;
            return $ret;
        }
        return false;
    }

}