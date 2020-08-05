<?php

namespace app\core;
class Router
{
    protected $routes=[];
    public Request $request;

    /**
     * Router constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function get($path, $callback){
        $this->routes['get'][$path] = $callback;
    }

    public function resolve(){
       $this->request->getPath();
    }
}