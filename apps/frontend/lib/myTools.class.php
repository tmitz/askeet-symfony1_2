<?php
class myTools
{
    public static function stripText($str) {
        $str = strtolower($str);

        // strip all non word chars
        $str = preg_replace('/\W/', ' ', $str);

        // replace all white space sections with a dash
        $str = preg_replace('/\ +/', '-', $str);

        // trim dashes
        $str = preg_replace('/\-$/', '', $str);
        $str = preg_replace('/^\-/', '', $str);

        return $str;
    }
}
