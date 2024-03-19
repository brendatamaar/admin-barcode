<?php

function get_next_key_array($array, $key)
{
    $keys = array_keys($array);
    $position = array_search($key, $keys);
    $nextKey = "1";
    if (isset($keys[$position + 1])) {
        $nextKey = $keys[$position + 1];
    }
    return $nextKey;
}

?>