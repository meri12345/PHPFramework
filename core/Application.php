<?php

namespace app\core;
class Application
{
    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;
    public Database $db;
    public Session $session;
    public static string $ROOT_DIR;
    public static Application $app;

    public function __construct($root,array $config){
        $this->request=new Request();
        $this->response=new Response();
        $this->session=new Session();
        self::$app=$this;
        $this->router = new Router($this->request,$this->response);
        self::$ROOT_DIR=$root;

        $this->db=new Database($config['db']);
    }

    public function run(){
        echo($this->router->resolve());
    }


}