<?php


namespace Ling\Bat;


/**
 * The TagTool class.
 *
 * A tag name is wrapped with curly brackets like {that}.
 * The tag can only be replaced with a string (or stringable).
 * A tag name must not contain the "}" (closing curly bracket) character.
 *
 *
 * Note: if you need to replace a tag with something else than a string, consider using the
 * [ArrayVariableResolver](https://github.com/lingtalfi/ArrayVariableResolver) utility.
 *
 */
class TagTool
{

    /**
     * Apply the given tags to the given array in place.
     *
     * This is recursive.
     *
     *
     * @param array $tags
     * @param array $arr
     * @return void
     */
    public static function applyTags(array $tags, array &$arr): void
    {
        array_walk_recursive($arr, function (&$v) use ($tags) {
            $v = preg_replace_callback('!\{([^}]+)}!', function ($match) use ($tags) {
                $tag = $match[1];
                if (array_key_exists($tag, $tags)) {
                    return $tags[$tag];
                }
                return $match[0];
            }, $v);
        });
    }

    /**
     * Injects the given tags into the given expression, and returns the result.
     *
     * The tags array is an array of tagName => value.
     *
     * @param string $expression
     * @param array $tags
     * @return string
     */
    public static function injectTags(string $expression, array $tags): string
    {
        $myTags = [];
        foreach ($tags as $name => $value) {
            $myTags['{' . $name . '}'] = $value;
        }
        return str_replace(array_keys($myTags), array_values($myTags), $expression);
    }

}