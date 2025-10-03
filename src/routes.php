<?php
use core\Router;

$router = new Router();
// o comando get define a rota que será acessada via GET
//dois parametros / e o controller @ metodo que será acessado
$router->get('/', 'HomeController@index');

$router->get('/fotos', 'FotosController@index');
$router->get('/music', 'MusicController@index');

$router->get('/novo', 'UsuariosController@add');
$router->post('/novo', 'UsuariosController@addAction');

$router->get('/teste', 'TesteController@index');

$router->get('/produtos', 'ProdutoController@index');
