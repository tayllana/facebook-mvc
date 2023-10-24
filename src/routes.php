<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/login', 'LoginController@signin');
$router->post('/login', 'LoginController@login');

$router->get('/cadastro', 'LoginController@signup');
$router->post('/cadastro', 'LoginController@cadastro');

$router->post('/post/new', 'PostController@new');

$router->get('/perfil/{id}', 'PerfilController@index');
$router->get('/perfil', 'PerfilController@index');


// $router->get('/pesquisa', '');

// $router->get('/amigos', '');
// $router->get('/fotos', '');
// $router->get('/configuracoes', '');
// $router->get('/sair', '');