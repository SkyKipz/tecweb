<?php
use TECWEB\MYAPI\Create\Create;
use TECWEB\MYAPI\Read\Read;
use TECWEB\MYAPI\Delete\Delete;
use TECWEB\MYAPI\Update\Update;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Slim\App();

// listar
$app->get('/product-list', function ($request, $response, $args) {
    $response = $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    $productos = new Read('marketzone');
    $productos->list();
    $response->getBody()->write(json_encode($productos->getData()));
    return $response;
});

// add
$app->post('/product-add', function($request, $response, $args){
    $response = $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    $productos = new Create('marketzone');
    $reqPost = $request->getParsedBody();
    if(isset($reqPost['nombre'])) {
        $productos->add($reqPost);
    }
    $response->getBody()->write(json_encode($productos->getData()));
    return $response;
});

// edit
$app->post('/product-edit', function ($request, $response, $args) {
    $response = $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    $productos = new Update('marketzone');
    $reqPost = $request->getParsedBody();
    if(isset($reqPost['id'])) {
        $productos->edit($reqPost);
    }
    $response->getBody()->write(json_encode($productos->getData()));
    return $response;
});

// borrar
$app->post('/product-delete', function($request, $response, $args){
    $response = $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    $productos = new Delete('marketzone');
    $reqPost = $request->getParsedBody();
    if(isset($reqPost['id'])) {
        $productos->delete($reqPost['id']);
    }
    $response->getBody()->write(json_encode($productos->getData()));
    return $response;
});

$app->run();
?>