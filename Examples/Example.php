<?php

function includeIfExists($file) {
    if (file_exists($file)) {
        return include $file;
    }
}

if ((!$loader = includeIfExists(__DIR__."/../vendor/autoload.php")) && (!$loader = includeIfExists(__DIR__."/../../../autoload.php"))) {
    die("You must set up the project dependencies, run the following commands:".PHP_EOL.
        "curl -s http://getcomposer.org/installer | php".PHP_EOL.
        "php composer.phar install".PHP_EOL);
}

function humanReadable($addressLine, $result, $iso) {
    echo "AddressLine: ".str_replace("\n", '\n', $addressLine).PHP_EOL;
    echo "Result: ".print_r($result, true).PHP_EOL;

    //markdown table output
    //echo '| '.$iso.' | '.str_replace("\n", '<br>', $addressLine).' | '.str_replace("\n", '<br>', print_r($result, true)).' | '.PHP_EOL;
}

$examples = array(
    array("PL", "KORNELA UJEJSKIEGO 12 M7\n30-102 KRAKÓW"),
    array("PL", "AL. 29 LISTOPADA 155C\n31-406 KRAKów"),
    array("PL", "AL. JERZEGO WASZYNGTONA 45/51\n04-008 WARSZAWA"),
    array("GB", "C/O BMW UK GROUPTAX FR-3-UK SUMMIT ONE SUMMIT AVENUE\nFARNBOROUGH\nGU14 0FB"),
    array("GB", "28-29 THE BROADWAY EALING\nLONDON\nW5 2NP"),
    array("GB", "28-29 THE BROADWAY\nEALING\nLONDON\n\nW5 2NP"),
    array("GB", "10 THE GRANGEWAY\nGRANGE PARK\nLONDON\nN21 2HA"),
    array("GB", "254 BANNERDALE ROAD\nSHEFFIELD\nS11 9FE"),
    array("PT", "R FIGUEIRAS N 616 MAIA\n4475-011\nMAIA"),
    array("LU", "40, RUE ANTOINE MEYER L-2153  LUXEMBOURG"),
    array("NL", " EEKHORSTWEG 00031 A 7942KC MEPPEL "),
    array("BE", "EZELSTRAAT 69 1 8000  BRUGGE"),
    array("IT", "P.ZA FERRAVILLA N. 2  20092 CINISELLO BALSAMO MI "),
    array("BG", "ул. Самуиловско шосе  №1А обл.СЛИВЕН, гр.СЛИВЕН 8800"),
    array("AT", "Herrengasse 44\n7471 Rechnitz"),
    array("NO", "Setesdalsveien 76\n4617 KRISTIANSAND S"),
    array("PL", "Not valid pattern"),
    array("XX", "Not valid isocode"),

);

use Ankalagon\ViesAddressFormatter\ViesFormatter;

foreach ($examples as $example) {
    $result = ViesFormatter::recognize($example[0], $example[1]);

    echo humanReadable($example[1], $result, $example[0]);
}


