<?php

/**
 * TODO:
 * USER CONTROLLER (
 *      profile, 
 *      +login, 
 *      +register
 * )
 * POST CONTROLLER (
 *      new post, 
 *      delete post, 
 *      edit post
 * )
 * HELPER (
 *      +form, 
 *      slug
 * )
 * SAVE/RETRIEVE ALL DATA VIA AJAX JQUERY
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
// Start the session
if (!isset($_SESSION['loged'])){
    $_SESSION['loged'] = false;
}

require_once 'config.php';
require_once 'vendor/autoload.php';

function noPage($message){
    $controller= prefix . 'ErrorController';
    $object = new $controller();
    $object->noPage($message);
}
if (!empty($_SERVER['PATH_INFO'])){
    $path = substr(strtolower($_SERVER['PATH_INFO']),1);
    $path = explode('/', $path);
    $controller = !empty($path[0]) ? $path[0] : null;
    $method = !empty($path[1]) ? $path[1] : null;
    $param = !empty($path[2]) ? $path[2] : null;
}

if (!empty($controller)) {
    $classFile = ucfirst($controller).'Controller';
} else {
    $classFile = null;
}

if (file_exists('app/controllers/' . $classFile . '.php') && ($classFile !== null)) {
    $class= prefix . $classFile;
    $object = new $class();
    if (!empty($method)) {
        if (method_exists($object, $method)) {
            if (isset($param)) {
                $object->$method($param);
            } else {
                $object->$method();
            }
        } else {
            noPage('This Method Doesn\'t exist');
        }
    } else {
        $object->index();
        
    }
} else {
    if ($classFile == null) {
        $controller = prefix . 'PageController';
        $page = new $controller();
        $page->index();

    } else {
        noPage('This Controller Doesn\'t exist');
    }
}

