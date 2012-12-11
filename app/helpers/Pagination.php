<?php

class Pagination
{
    public static function create($url, $count, $p = 0, $m = 10)
    {
        $s = isset($_GET['s']) ? '?s=' . $_GET['s'] : '';
        $data = array('url' => $url, 'count' => ceil($count / $m), 'p' => $p, 's' => $s);
        return Import::view($data, '_snippet', 'pagination');
    }
}