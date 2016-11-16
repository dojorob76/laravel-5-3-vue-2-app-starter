<?php

/**
 * Generate flash messages using the Flasher class to display to users.
 *
 * @param null $title
 * @param null $message
 * @return \App\Http\Flasher|mixed
 */
function flasher($title = null, $message = null)
{
    $flash = app('App\Http\Flasher');

    if (func_num_args() == 0) {
        return $flash;
    }

    return $flash->message($message, $title);
}

/**
 * Determine whether 'a' or 'an' should be used as an article, and return the original string with the correct
 * article prepended.
 *
 * @param string $string
 * @return string
 */
function setPreArticle($string)
{
    $vowels = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];

    $isAn = false;

    foreach ($vowels as $vowel) {
        if (starts_with($string, $vowel)) {
            $isAn = true;
            break;
        }
    }

    return $isAn ? 'an ' . $string : 'a ' . $string;
}

/**
 * Create and return a delimited string from an array.
 *
 * @param array $array
 * @param string $delimiter (',', ':', '-', etc.)
 * @return string
 */
function getDelimitedStringFromArray($array, $delimiter)
{
    // Instantiate empty string
    $string = '';
    // Add each item of the array to the string
    foreach ($array as $item) {
        $string .= $item . $delimiter;
    }
    // Remove trailing delimiter
    $delimitedString = rtrim($string, $delimiter);

    return $delimitedString;
}

/**
 * @param int $xNum
 * @param int $yNum
 * @param string $direction
 * @return int
 */
function calculatePercentage($xNum, $yNum, $direction = 'up')
{
    $direction = $direction == 'up' ? PHP_ROUND_HALF_UP : PHP_ROUND_HALF_DOWN;

    return intval(round(($xNum * 100) / $yNum, 0, $direction));
}