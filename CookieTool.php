<?php


namespace Ling\Bat;


/**
 * The CookieTool class.
 */
class CookieTool
{


    /**
     * Sets a cookie.
     * By default, the cookie lasts the specified number of days and is secure (httponly=true and secure=true).
     *
     * This method must be called before any output is sent to the browser.
     * See https://www.php.net/manual/en/features.cookies.php for more info.
     *
     *
     * Available options:
     * - path: string, same as php doc
     * - domain: string, same as php doc
     * - secure: bool, same as php doc
     * - httponly: bool, same as php doc
     * - expires: string, same as php doc. If set, will override the $nbDays argument.
     *
     *
     *
     * @param string $name
     * @param $value
     * @param int $nbDays
     * @param array $options
     *
     */
    public static function add(string $name, $value, int $nbDays = 0, array $options = []): void
    {
        $path = $options['path'] ?? '';
        $domain = $options['domain'] ?? '';
        $secure = $options['secure'] ?? true;
        $httponly = $options['httponly'] ?? true;
        $expires = $options['expires'] ?? null;


        if (null === $expires) {
            $expire = time() + 86400 * $nbDays;
        } else {
            $expire = $expires;
        }
        setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
    }


    /**
     * Returns the array of all cookie names sent by the client.
     *
     * @return array
     */
    public static function all(): array
    {
        return $_COOKIE;
    }


    /**
     * Deletes the given cookie(s).
     * $cookies can be either the name of the cookie, or an array of names.
     *
     *
     * @param $cookies
     */
    public static function delete($cookies): void
    {
        if (false === is_array($cookies)) {
            $cookies = [$cookies];
        }
        foreach ($cookies as $cookie) {
            setcookie($cookie, '', -1);
        }
    }

    /**
     * Returns of the $name cookie if set, or the default value otherwise.
     *
     * @param string $name
     * @param null $default
     */
    public static function get(string $name, $default = null)
    {
        return $_COOKIE[$name] ?? $default;
    }


    /**
     * Returns whether the cookie with name=$name is set.
     *
     * @param string $name
     * @return bool
     */
    public static function has(string $name): bool
    {
        return array_key_exists($name, $_COOKIE);
    }

}