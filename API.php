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
    return $db;
}
/*
function createDatabaseTable()
{
    $db = connect();
    $db->exec('DROP TABLE `utilizatori`');
    $db->exec("CREATE TABLE `utilizatori` (id_utilizator INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY, nume_utilizator VARCHAR(10) NOT NULL, parola INT(6) NOT NULL, email VARCHAR(20))");
}
*/
//contact




//evenimente
function getEvenimente($db)
{
    
    $res = $db->query('SELECT * FROM eveniment');
    $row=$res->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getEvenimentId($db, $id)
{
    $res = $db->query('SELECT * FROM eveniment WHERE id_eveniment='.$id);
    $row=$res->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function getEvenimentNume($db, $nume)
{
    $res = $db->query('SELECT * FROM eveniment WHERE nume_eveniment='.$nume);
    $row=$res->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getEvenimentData($db, $data)
{
    $res = $db->query('SELECT * FROM eveniment WHERE data='.$data);
    $row=$res->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getEvenimentCategorie($db, $categorie)
{
    $res = $db->query('SELECT * FROM eveniment WHERE categorie='.$categorie);
    $row=$res->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function stergeEveniment($db,$id)
{
    $queryString = 'DELETE FROM eveniment WHERE id_eveniment='.$id;
    $db->query($queryString);
}
function adaugaEveniment($db,$nume,$data,$categoria,$locatia,$utilizator,$detalii)
{
    $queryString = 'INSERT INTO `eveniment` (nume_eveniment,data,categorie,locatia,id_utilizator,detalii) VALUES ("' .$nume. '","' .$data. '","' .categorie. '","'.locatia.'","' .utilizator. '","' .$detalii. '")';
    $db->query($queryString);
    return $db->lastInsertId();
}
function modificaEveniment($db,$id,$nume,$data,$categorie,$locatie,$utilizator,$detalii)
{
    $queryString = 'UPDATE `eveniment` SET `nume_eveniment`="'.$nume.'",`data`='.$data.',`categorie`="'.$categorie.'",`locatia`="'.$locatie.'",`id_utilizator`='.$utilizator.',`detalii`="'.$detalii.'" WHERE id_eveniment='.$id;
    $db->query($queryString);
    return $db->lastInsertId();
}

function getEvenimenteUtilizator($db, $id)
{
	$res = $db->query('SELECT * FROM eveniment where id_utilizator='.$id);
    $row=$res->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}

//utilizatori
function adaugaUtilizator($db,$nume,$parola,$email)
{
    $queryString = 'INSERT INTO `utilizatori` (nume_utilizator,parola,email) VALUES ("' .$nume. '","' .$parola. '","' .$email. '")';
    $db->query($queryString);
    return $db->lastInsertId();
}
function modificaUtilizator($db,$id,$nume,$parola,$email)
{
    $queryString = 'UPDATE `utilizatori` SET `nume_utilizator`="'.$nume.'",`parola`='.$parola.',`email`="'.$email.'" WHERE id_utilizator='.$id;
    $db->query($queryString);
    return $db->lastInsertId();
}

function getUtilizator($db, $id)
{
    
    $res = $db->query('SELECT * FROM utilizatori WHERE id_utilizator='.$id);
    $row=$res->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function getUtilizatori($db)
{
    
    $res = $db->query('SELECT * FROM utilizatori');
    $row=$res->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}


function stergeUtilizator($db,$id)
{
    $queryString = 'DELETE FROM `utilizatori` WHERE id_utilizator='.$id;
    $db->query($queryString);
}

function getUtilizatorEmail($db, $email)
{
    
    $res = $db->query('SELECT * FROM utilizatori WHERE email='.$email);
    $row=$res->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function getUtilizatorNume($db, $nume)
{
    $res = $db->query('SELECT * FROM utilizatori WHERE nume_utilizator='.$nume);
    $row=$res->fetch(PDO::FETCH_ASSOC);
    return $row;
}

//requesturi
$settings =  [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$app = new Slim\App($settings);
//contact




//evenimente
$app->get('/evenimenteUtilizator/{id_utilizator}', function (Request $request, Response $response) {
    $db = connect();
	$id=$request->getAttribute('id_utilizator');
    $rsp = getEvenimenteUtilizator($db,$id);
    return $response->withJSON(array("evenimente" => $rsp));
});
$app->get('/evenimente', function (Request $request, Response $response) {
    $db = connect();
    $rsp = getEvenimente($db);
    return $response->withJSON(array("evenimente" => $rsp));
});
$app->get('/evenimentId/{id_eveniment}', function (Request $request, Response $response) {
    $db = connect();
    $id = $request->getAttribute('id_eveniment');
    $rsp = getEvenimentId($db, $id);
    return $response->withJSON(array("eveniment" => $rsp));
});
$app->get('/evenimentNume/{nume_eveniment}', function (Request $request, Response $response) {
    $db = connect();
    $nume = $request->getAttribute('nume_eveniment');
    $rsp = getEvenimentNume($db, $nume);
    return $response->withJSON(array("eveniment" => $rsp));
});
$app->get('/evenimentData/{data}', function (Request $request, Response $response) {
    $db = connect();
    $data = $request->getAttribute('data');
    $rsp = getEvenimentData($db, $data);
    return $response->withJSON(array("eveniment" => $rsp));
});
$app->get('/evenimentCategorie/{categorie}', function (Request $request, Response $response) {
    $db = connect();
    $categorie = $request->getAttribute('categorie');
    $rsp = getEvenimentCategorie($db, $categorie);
    return $response->withJSON(array("eveniment" => $rsp));
});
$app->delete('/eveniment/{id_eveniment}', function (Request $request, Response $response) {
    $db = connect();
    $id = $request->getAttribute('id_eveniment');
    stergeEveniment($db, $id);
    return $response->withJSON(array("mesaj" => "succes!"));
});
$app->post('/adaugaEveniment/{nume_eveniment},{data},{categorie},{locatie},{utilizator},{detalii}', function (Request $request, Response $response) {
    $db = connect();
	$nume = $request->getAttribute('nume_eveniment');
    $data = $request->getAttribute('data');
    $categorie = $request->getAttribute('categorie');
	$locatie = $request->getAttribute('locatie');
	$utilizator = $request->getAttribute('utilizator');
	$detalii = $request->getAttribute('detalii');
    $id=adaugaEveniment($db, $nume,$data,$categoria,$locatia,$utilizator,$detalii);
    return $response->withJSON(array("mesaj" => "Succes!","id"=>$id));
});
$app->put('/modificaEveniment/{id},{nume_eveniment},{data},{categorie},{locatie},{utilizator},{detalii}', function (Request $request, Response $response) {
    $db = connect();
    $nume = $request->getAttribute('nume_eveniment');
    $data = $request->getAttribute('data');
    $categorie = $request->getAttribute('categorie');
    $locatie = $request->getAttribute('locatie');
    $utilizator = $request->getAttribute('utilizator');
    $detalii = $request->getAttribute('detalii');
	$id = $request->getAttribute('id');
	modificaEveniment($db,$id,$nume,$data,$categorie,$locatie,$utilizator,$detalii);
    return $response->withJSON(array("mesaj" => "Succes!","id"=>$id));
});

//utilizator
$app->post('/adaugaUtilizator/{nume_utilizator},{parola},{email}', function (Request $request, Response $response) {
    $db = connect();
    $nume = $request->getAttribute('nume_utilizator');
    $parola = $request->getAttribute('parola');
    $email = $request->getAttribute('email');
    $id=adaugaUtilizator($db, $nume,$parola,$email);
    return $response->withJSON(array("mesaj" => "Succes!","id"=>$id));
});

$app->put('/modificaUtilizator/{id},{nume_utilizator},{parola},{email}', function (Request $request, Response $response) {
    $db = connect();
    $nume = $request->getAttribute('nume_utilizator');
    $parola = $request->getAttribute('parola');
    $email = $request->getAttribute('email');
	$id = $request->getAttribute('id');
    modificaUtilizator($db,$id,$nume,$parola,$email);
    return $response->withJSON(array("mesaj" => "Succes!","id"=>$id));
});

$app->get('/utilizator/{id_utilizator}', function (Request $request, Response $response) {
    $db = connect();
    $id = $request->getAttribute('id_utilizator');
    $rsp = getUtilizator($db, $id);
    return $response->withJSON(array("utilizator" => $rsp));
});

$app->get('/utilizatori', function (Request $request, Response $response) {
    $db = connect();
    $rsp = getUtilizatori($db);
    return $response->withJSON(array("utilizatori" => $rsp));
});

$app->get('/utilizatorNume/{nume_utilizator}', function (Request $request, Response $response) {
    $db = connect();
    $nume = $request->getAttribute('nume_utilizator');
    $rsp = getUtilizatorNume($db, $nume);
    return $response->withJSON(array("utilizator" => $rsp));
});

$app->get('/utilizatorEmail/{email}', function (Request $request, Response $response) {
    $db = connect();
    $email = $request->getAttribute('email');
    $rsp = getUtilizatorEmail($db, $email);
    return $response->withJSON(array("utilizator" => $rsp));
});

$app->delete('/utilizator/{id_utilizator}', function (Request $request, Response $response) {
    $db = connect();
    $id = $request->getAttribute('id_utilizator');
    stergeUtilizator($db, $id);
    return $response->withJSON(array("mesaj" => "succes!"));
});

$app->run();
?>

