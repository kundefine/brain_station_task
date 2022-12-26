<?php

const HOST = "localhost";
const DB_USER = "root";
const DB_PASSWORD = "";
const DB_NAME = "brain_ecommerce";

function dd($data, $e = false)
{
    echo '<pre>';
    is_array($data) ? print_r($data) : var_dump($data);
    echo '</pre>';
    $e ? exit("its time to exit") : null;

}