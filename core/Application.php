<?php

namespace app\core;
class Application
{
    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;
    public static string $ROOT_DIR;
    public static Application $app;

    public function __construct($root){
        $this->request=new Request();
        $this->response=new Response();
        self::$app=$this;
        $this->router = new Router($this->request,$this->response);
        self::$ROOT_DIR=$root;
    }

    public function run(){
        echo($this->router->resolve());
    }


}