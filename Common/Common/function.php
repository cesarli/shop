<?php
function xmp($data){
    echo '<pre>';
    var_dump($data);
    echo "</pre>";
}

function getTree($arr, $p_id=0, $deep=0) {
    static $tree = array();

    foreach($arr as $row) {
        if ($row['parent_id'] == $p_id) {
            $row['deep'] = $deep;
            $tree[] = $row;
            getTree($arr, $row['class_id'], $deep+1);
        }
    }
    return $tree;
}