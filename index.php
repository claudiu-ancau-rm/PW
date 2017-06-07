<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
$app->put('/plot/{id}', function (Request $request, Response $response) {
    global $db;
    $id = $request->getAttribute('id');
    $rsp = createPlotRepresentation ($db, $id) ;
    return $response->withJSON (array("response"=>"should return a neutral object, maybe based on plot ID..."));
});

$app->get('/plot/{id}', function (Request $request, Response $response){
	global $db ;
    $id = $request->getAttribute('id');
    $rsp = getPlotData ($db, $id) ;
    return $response->withJSON (array("response"=>$rsp));
});
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

$app->post('/graph/{id}/function/{fntype}', function (Request $request, Response $response) {
    global $db ;
    $id = $request->getAttribute('id');
    $fn = $request->getAttribute('fntype');
    $rsp = updatePlotFunction ($db, $id, $fn) ;
    return $response->withJSON(array("response"=>$rsp)) ;
});

$app->post('/graph/{id}/terminal/{termtype}', function (Request $request, Response $response) {
    global $db ;
    $id = $request->getAttribute('id');
    $tt = $request->getAttribute('termtype');
    $rsp = updatePlotTerminal ($db, $id, $tt) ;
    return $response->withJSON(array("response"=>$rsp)) ;
});

$app->get('/graph/{id}/function', function (Request $request, Response $response) {
    global $db ;
    $id = $request->getAttribute('id');
    $fnform = getPlotFunction ($db, $id) ;
    return $response->withJSON(array("response"=>array("id"=>"$id", "function"=>"$fnform")));
});
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('mysqlitedb.db');
    }
}
$db = new MyDB();


function createDatabaseTable ($db) {
  $db->exec('DROP TABLE `plotstable`');
  $db->exec('CREATE TABLE `plotstable` (`fctname` STRING, `term` STRING, `output` STRING, `id` INTEGER PRIMARY KEY AUTOINCREMENT)');
}

function getPlotFunction ($db, $id) {
  $res = $db->query ('SELECT * FROM `plotstable` WHERE `id`='.$id) ;
  if (($res->numColumns() == 1) && ($res->columnType(0) == SQLITE3_NULL)) { 
    // zero rows. 
	return "x" ;
  } else {
    // some rows. Consider the first one only!
	$row = $res->fetchArray() ;
	return $row['fctname'];
  } 
}

function getPlotData ($db, $id, $flavor=0) {
  $res = $db->query ('SELECT * FROM `plotstable` WHERE `id`='.$id) ;
  if (($res->numColumns() == 1) && ($res->columnType(0) == SQLITE3_NULL)) {
	return array();
  } else {
	$row = $res->fetchArray() ;
	if ($flavor == 1) return array("function"=>$row['fctname'], "terminal"=>$row['term'], "output"=>$row['output']);
	else return array("function"=>$row['fctname'], "terminal"=>$row['term']);
  } 
}

function createPlotEntry ($db) {
  $queryString = 'INSERT INTO `plotstable` (`output`) VALUES ("'. tempnam("outputs", "OUT") .'")';
  $db->query ($queryString) ;
  return $db->lastInsertRowId() ;
}

function updatePlotFunction ($db, $id, $plotfct) {
  $queryString = 'UPDATE `plotstable` SET `fctname`="'.$plotfct.'" WHERE `id`='.$id ;
  $db->query ($queryString) ;
  return $queryString ;  
}
function updatePlotTerminal ($db, $id, $plotterm) {
  $queryString = 'UPDATE `plotstable` SET `term`="'.$plotterm.'" WHERE `id`='.$id ;
  $db->query ($queryString) ;
  return $queryString ;  
}
/*
function createPlotRepresentation ($db, $id) {
  $plotData = getPlotData ($db, $id, 1) ; 
  if (empty($plotData["function"]) || empty ($plotData["terminal"])) {
    return array("error"=>"Missing mandatory data!") ;
  } else {
    $cmdLine ='"C:\\Program Files (x86)\\gnuplot\\bin\\gnuplot.exe" '.$plotData['output'] ;
    $outFile = dirname($plotData['output']) . "\\" .  basename($plotData['output'], ".tmp") ;
	switch ($plotData["terminal"]) {
	case 'jpeg':	case 'jpg':	case 'JPEG':
	  $outFile = $outFile . ".jpg" ;
	  break ;
	case 'png':	case 'PNG':
	  $outFile = $outFile . ".png" ;
	  break ;
	default:
	  $outFile = $outFile . ".out" ;
	  break ;
	}
	plotFile = <<<EOPLOT
set terminal {$plotData['terminal']}
set output '{$outFile}'
plot {$plotData['function']}
unset output
EOPLOT;
    file_put_contents($plotData['output'], $plotFile);
	exec ($cmdLine) ;	
	return $outFile;
  }
}
*/


});
$app->run();