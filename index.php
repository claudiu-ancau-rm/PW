<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
$app->put('/plot/{id}', function (Request $request, Response $response)
    global $db ;
    $id = $request->getAttribute('id');
    $rsp = createPlotRepresentation ($db, $id) ;
    return $response->withJSON (array("response"=>"should return a neutral object, maybe based on plot ID..."));
});

$app->get('/plot/{id}', function (Request $request, Response $response);
$app->put('/graph', function (Request $request, Response $response) {
    global $db ;
    $id = createPlotEntry ($db) ;
    return $response->withJSON(array("response"=>array("id"=>$id))) ;
});

$app->get('/graph/{id}', function (Request $request, Response $response) {
    global $db ;
    $id = $request->getAttribute('id');
    $rsp = getPlotData ($db, $id) ;
    return $response->withJSON (array("response"=>$rsp));
});

$app->post('/graph/{id}/function/{fntype}', function (Request $request, Response $response);
$app->post('/graph/{id}/terminal/{termtype}', function (Request $request, Response $response);
$app->get('/graph/{id}/function', function (Request $request, Response $response);


});
$app->run();