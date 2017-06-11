<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require '../vendor/autoload.php';

$app = new \Slim\App;


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
{   $db = connect();
    $db->exec('DROP TABLE `utilizatori`');
    $db->exec("CREATE TABLE `utilizatori` (id_utilizator INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY, nume_utilizator VARCHAR(10) NOT NULL, parola INT(6) NOT NULL, email VARCHAR(20))");
}


function createPlotEntry()
{
    $db = connect();
    $queryString = 'INSERT INTO `utilizatori` (`id`) VALUES ("' . tempnam("user_name", "OUT") . '")';
    $db->query($queryString);
    return $db->lastInsertRowId();
}

function getPlotFunction($db, $id)
{
    $res = $db->query('SELECT * FROM `utilizatori` WHERE `id`=' . $id);
    $row = $res->fetchArray();
    return $row['user_name'];
}

$app->post('/plot/{id}', function (Request $request, Response $response) {
    $db = connect();
    $id = $request->getAttribute('id');
    $rsp = createPlotEntry($db, $id);
    return $response->withJSON(array("response" => "should return a neutral object, maybe based on plot ID..."));
});

$app->get('/plot/{id}', function (Request $request, Response $response) {
    $db = connect();
    $id = $request->getAttribute('id');
    $rsp = getPlotFunction($db, $id);
    return $response->withJSON(array("response" => $rsp));
});
$app->run();
?>

