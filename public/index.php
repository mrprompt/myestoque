<?php

//constante app root e pegou diretorio pai do diretorio public
define('APP_ROOT', dirname(__DIR__));
chdir(APP_ROOT);

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require '/vendor/autoload.php';

$app = new Application();

//MIDDLEWARES DE APLICAÇÃO
//$app->before(function(Request $request){
//    print 'Middleware Before - ';
//});
//
//$app->after(function(Request $request, Response $response){
//    print 'Middleware After - ';
//});
//
//$app->finish(function(Request $request, Response $response){
//    print 'Middleware Finish - ';
//});

//MIDDLEWARES DE ROTAS
$app->get('/',function() use ($app) {
    return 'TESTE ROTA - ';
})
->before(function(){
    print 'Antes dessa rota - ';
});

$app->get('usuarios',function() use ($app) {
    return 'TESTE ROTA USUARIOS - ';
});

$app->run();

