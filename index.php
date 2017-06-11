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


function createPlotEntry()
{
    $db = connect();
    $queryString = 'INSERT INTO `utilizatori` (`id_utilizator`) VALUES ("' . tempnam("user_name", "OUT") . '")';
    $db->query($queryString);
    return $db->lastInsertId();
}

function getPlotFunction($db, $id)
{
    $res = $db->query('SELECT * FROM `utilizatori` WHERE `id_utilizator`=1');

    $row = $res->fetchArray();
    return $row['nume_utilizator'];
}
$settings =  [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$app = new Slim\App($settings);
$app->post('/plot/{id}', function (Request $request, Response $response) {
    $db = connect();
    $id = $request->getAttribute('id_utilizator');
    $rsp = createPlotEntry($db, $id);
    return $response->withJSON(array("response" => $rsp));
});

$app->get('/plot/{id}', function (Request $request, Response $response) {
    $db = connect();
    $id = $request->getAttribute('id_utilizator');
    $rsp = getPlotFunction($db, $id);
    return $response->withJSON(array("response" => $rsp));
});
$app->run();
?>

