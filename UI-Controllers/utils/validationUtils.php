<?php
/**
 * Function for validation user parameters
 * @param $data
 * @return string
 */
function isValid($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return !empty($data);
}