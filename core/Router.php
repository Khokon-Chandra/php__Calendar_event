<?php

namespace core;
/**
 * Router class
 */
class Router
{
    private $routes = [];
    protected $request;

    public function __construct(Request $request,)
    {
        $this->request = $request;
    }   

    public function get($path,$callback)
    {
        $this->routes['get'][$path] = $callback;
    }


    public function post($path,$callback)
    {
        $this->routes['post'][$path] = $callback;
    }


    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path]??false;
        if(!$callback){
            return view('404');
        }
        if(is_string($callback)){
            return $callback;
        }

        if(is_array($callback)){
            $callback[0] = new $callback[0]();
        }
        return call_user_func($callback,$this->request);
    }
    

}
