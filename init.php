<?php 
require 'vendor/autoload.php';

function error ()
{
    require '404.php';
    exit();
}

function debug(...$vars)
{
    foreach ($vars as $var) {
        echo '<pre>';
        print_r($var);
        echo '<pre>';
    }
    
}

function get_PDO(): PDO
{
    return $pdo = new PDO('mysql:host=localhost; dbname=tutocalendar', 'root','root', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
}

function security(?string $data): string
{   
    if ($data === null) {
        return '';
    }
    return htmlentities($data);
}

function render(string $view, $params = [])
{
    extract($params);
    include "views/{$view}.php";
}
?>