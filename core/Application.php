<?php
namespace core;
/**
 * Application class
 */
class Application
{
    public Request $request;
    public Router $route;
    public View $view;
    public Database $db;
    public static Application $app;
    public function __construct()
    {
        $this->view = new View();
        $this->request = new Request();
        $this->route   = new Router($this->request);
        $this->db      = new Database();
        self::$app     = $this;
    }


    public function runs()
    {
        echo $this->route->resolve();
    }
}
