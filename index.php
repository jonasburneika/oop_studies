<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('baseURL','/mvc/');
function noPage($message){
    include_once 'controllers/ErrorController.php';
    $object = new ErrorController;
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

if (file_exists('controllers/' . $classFile . '.php') && ($classFile !== null)) {
    include_once 'controllers/' . $classFile . '.php';
    $object = new $classFile;
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
        include_once 'controllers/PageController.php';
        $page = new PageController;
        $page->index();

    } else {
        noPage('This Controller Doesn\'t exist');
    }
}

