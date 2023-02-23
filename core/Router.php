<?php

namespace core;

class Router
{
    private $controller = 'Site';
    private $method = 'home';
    private $param = [];

    // o router dentro da function contruct vai cuidar da variavel
    public function __construct()
    {
        $router = $this->url();
        // Esse if vai ver se o arquivo existe dentro da controller e colocar na url
        //  
        if (file_exists('app/controllers/' . ucfirst($router[0]) . '.php')):
            // o $this controllers recebe a variavel router na posição 0
            // conntroller esta privado ali em cima
            $this->controller = $router[0];
            unset($router[0]);
            // o unset serve para limpar o 0 do array            
        endif;
        //
        $class = "\\app\\controllers\\" . ucfirst($this->controller);
        $object = new $class;

        if (isset($router[1]) and method_exists($class, $router[1])) :
            $this->method = $router[1];
            unset($router[1]);
        endif;
        // o atributo param recebe router que tem 3 parametros
        $this->param = $router ? array_values($router) : [];
        // object é a variavel ali em cima 
        call_user_func_array([$object, $this->method], $this->param);
    }
   
    private function url()
    {
         // a variavel router foi criado dentro do htaccess
        // RewriteRule ^(.*)$ index.php?router=$1 [QSA,L]
        // aqui vai tratar a url
        $parse_url = explode("/", filter_input(INPUT_GET, 'router', FILTER_SANITIZE_URL));
        return $parse_url;
    }
}
