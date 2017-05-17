<?php


namespace Bat;


class SessionTool
{


    /**
     * @param $keys, array or string representing the key(s) to destroy from the session.
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

}