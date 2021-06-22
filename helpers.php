<?php
use core\Application;

$app = new Application();
$route = $app->route;

function view($view,$params=[]){
    return Application::$app->view->renderView($view,$params);
}
