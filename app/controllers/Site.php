<?php 

namespace app\controllers;
// toda página que criar tem que ser referenciada aqui.
// dessa maneira ela vai ser chamada pelas rotas
class Site
{
    public function home()
    {
        require_once __DIR__ . '/../view/home.php';
    }

    
}