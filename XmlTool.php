<?php


namespace Bat;


class XmlTool
{


    /**
     *
     * Return an array corresponding to the given xml structure, or false in case of syntax error.
     *
     * The content of a node is what's BEFORE a node's children (if the node has children).
     * This means if you write some string in a node, but AFTER it's first child,
     * then the content will be empty.
     *
     * In other words, in this first example the content is kebab:
     *
     * <node>
     *      kebab
     *      <child></child>
     * </node>
     *
     * While in this second example the content is empty:
     *
     * <node>
     *      <child></child>
     *      kebab
     * </node>
     *
     *
     * The xml content must always encapsulate all nodes in a root node,
     * which name can be anything.
     * If your content has multiple root nodes, like the following:
     *
     * <node1></node1>
     * <node2></node2>
     *
     * Then only the first node, node1 in this case, will be parsed.
     *
     *
     *
     *
     * @param $xml
     * @param bool $trimContent
     *
     * @return array|false, the array corresponding to the given xml structure
     */
    public static function toArray($xml, $trimContent = true)
    {
        $parser = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, $xml, $tags);
        xml_parser_free($parser);

        $elements = array();  // the currently filling [child] XmlElement array
        $stack = array();
        foreach ($tags as $tag) {
            if (null === $tag) {
                continue;
            }


            $index = count($elements);
            if ($tag['type'] == "complete" || $tag['type'] == "open") {

                $content = (array_key_exists('value', $tag)) ? $tag['value'] : "";
                if (true === $trimContent) {
                    $content = trim($content);
                }

                $elements[$index] = [];
                $elements[$index]['name'] = $tag['tag'];
                $elements[$index]['attributes'] = (array_key_exists('attributes', $tag)) ? $tag['attributes'] : [];
                $elements[$index]['content'] = $content;
                $elements[$index]['children'] = [];
                if ($tag['type'] == "open") {  // push
                    $stack[count($stack)] = &$elements;
                    $elements = &$elements[$index]['children'];
                }

            }
            if ($tag['type'] == "close") {  // pop
                $elements = &$stack[count($stack) - 1];
                unset($stack[count($stack) - 1]);
            }
        }
        if (array_key_exists(0, $elements)) {
            return $elements[0];  // the single top-level element
        }
        return false;
    }

}