<?php

function debug($data) {
    echo '<pre>';
    echo print_r($data, true);
    echo '</pre>';
}

function redirect($http = false)
{
    if($http) {
        $redirect = $http;
    }
    else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }
    header("Location: $redirect");
    exit;
}