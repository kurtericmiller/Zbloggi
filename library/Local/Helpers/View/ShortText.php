<?php
class View_Helper_ShortText extends Zend_View_Helper_Abstract
{
    public function shortText($text)
    {
        $text_segs = preg_split("/<p><!--more--><\/p>/", $text);
        if (count($text_segs) == 1) {
            $text_segs = preg_split("/<!--more-->/", $text);
        }
        return $text_segs[0];
    }
}
