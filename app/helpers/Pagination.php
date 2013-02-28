<?php

class Pagination
{
    public static function create($url, $count, $p = 0, $m = 10)
    {
        $s = isset($_GET['s']) ? '?s=' . $_GET['s'] : '';
        $data = array('url' => $url, 'count' => ceil($count / $m), 'p' => $p, 's' => $s);
        return Import::view($data, '_snippet', 'pagination');
    }
	public static function create_data($url, $count, $p = 0, $m = 10)
    {
        $i = isset($_GET['i']) ? '?i=' .$_GET['i'] : '';
		$f = isset($_GET['f']) ? '&f=' .$_GET['f'] : '';
		
		$s = isset($_GET['s']) ? '&s=' . $_GET['s'] : '';		
        $data = array('url' => $url, 'count' => ceil($count / $m), 'p' => $p, 's' => $s, 'i' => $i, 'f' => $f);
        return Import::view($data, '_snippet', 'pagination_data');
    }
}