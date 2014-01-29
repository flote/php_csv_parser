<?php

/**
 * prints or returns output of print_r wrapped in HTML <pre> tag. optional parameters $return and $comment
 *
 * @param mixed[] $misc
 * @param bool  $return
 * @param bool  $comment
 *
 * @return void or mixed[]
 */
function pre_r($misc, $return = false, $comment = false)
{

    if ($return) {
        $returner ="";
        if ($comment)
            $returner .="<!--\n";
        $returner .= "<pre>".print_r($misc, true)."</pre>";
        if ($comment)
            $returner .="\n-->";

        return $returner;
    } else {

        if ($comment)
            echo "<!--\n";
        echo "<pre>";
        print_r($misc);
        echo "</pre>";
        if ($comment)
            echo "\n-->";
    }
}

require "Csv_parser.php";


$test_string = "
first;last;least
asdf;gogo;gaga
";

$results = Csv_parser::delimit_test($test_string);


pre_r($results);

include "tpl.php";