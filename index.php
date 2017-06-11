<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require '../vendor/autoload.php';


function connect()
{
    $db = new PDO("mysql:host=localhost;dbname=eveniment", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
    return $db;
}


function createDatabaseTable()
{
    $db = connect();
    $db->exec('DROP TABLE `utilizatori`');
    $db->exec("CREATE TABLE `utilizatori` (id_utilizator INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY, nume_utilizator VARCHAR(10) NOT NULL, parola INT(6) NOT NULL, email VARCHAR(20))");
}


function createPlotEntry($db,$nume,$parola,$email)
{
    $queryString = 'INSERT INTO `utilizatori` (nume_utilizator,parola,email) VALUES ("' .$nume. '","' .$parola. '","' .$email. '")';
    $db->query($queryString);
    return $db->lastInsertId();
}

function getPlotFunction($db, $id)
{
    
    $res = $db->query('SELECT id_utilizator FROM utilizatori WHERE id_utilizator=1');
    $row=mysqli_fetch_array($res,MYSQLI_NUM);
    echo "a".$row['id_utilizator']."a";
    return $row['nume_utilizator'];
}
$settings =  [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$app = new Slim\App($settings);
$app->post('/adauga/{nume_utilizator},{parola},{email}', function (Request $request, Response $response) {
    $db = connect();
    $nume = $request->getAttribute('nume_utilizator');
    $parola = $request->getAttribute('parola');
    $email = $request->getAttribute('email');
    createPlotEntry($db, $nume,$parola,$email);
    return $response->withJSON(array("mesaj" => "Succes!"));
});

$app->get('/plot/{id_utilizator}', function (Request $request, Response $response) {
    $db = connect();
    $id = $request->getAttribute('id_utilizator');
    $rsp = getPlotFunction($db, $id);
    return $response->withJSON(array("response" => $rsp));
});
$app->run();
?>

