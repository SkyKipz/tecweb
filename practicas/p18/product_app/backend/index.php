<?php
use TECWEB\MYAPI\Create\Create;
use TECWEB\MYAPI\Read\Read;
use TECWEB\MYAPI\Delete\Delete;
use TECWEB\MYAPI\Update\Update;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Slim\App();

// listar
$app->get('/product-list', function ($request, $response, $args) {
    $productos = new Read('marketzone');
    $productos->list();
    echo $productos->getData();
});

// listar
$app->post('/product-add[/{id}]', function ($request, $response, $args) {
    $productos = new Create('marketzone');
    $productos->add( json_decode( json_encode($_POST) ) );
    echo $productos->getData();
});


$app->run();
?>