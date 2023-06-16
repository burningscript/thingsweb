<?php

$enable = true;
$timeLimitMinutes = 0;


//TODO: Drossel API 
require_once 'config.php';
require_once 'vendor/sql.php';
$db = new MysqliDb ($server, $user, $pw, $db);

function sauber($data)
{
    $data = trim($data);
    $data = strip_tags($data);
    return $data;
}

function checkTimes($lasttime)
{
$datetime1 = new DateTime($lasttime);//start time
$datetime2 = new DateTime("now");//end time
$interval = $datetime1->diff($datetime2);
return $interval->format('%i');

}

if($enable == false){
	exit("ERROR: API DISABLED");
}


//IS SECRET PROVIDED?
if(!isset($_POST["secret"]) || empty($_POST["secret"])){
	exit("ERROR: NO SECRET PROVIDED");
}


//CLEAN VARS
$inboxItems = sauber($_POST["inbox"]);
$todayItems = sauber($_POST["today"]);
$everyday = sauber($_POST["everyday"]);
$someday = sauber($_POST["someday"]);
$secret = sauber($_POST["secret"]);



//IS SECRET VALID?
$db->where ("secret", $secret);
$apiDBAnswer = $db->getOne("things_api");


if ($db->count == 1) {
//Secret found


if(checkTimes($apiDBAnswer["lastrequest"]) < $timeLimitMinutes){
	exit("ERROR: API HOURLY LIMIT REACHED. WAIT ".$timeLimitMinutes-checkTimes($apiDBAnswer["lastrequest"])." MINUTES");
}


//UPDATE TODO
$updatedData = Array (
	'inbox' => $inboxItems,
	'today' => $todayItems,
	'everyday' => $everyday,
	'someday' => $someday,
	'lastapi' => $db->now()



);

$db->where ('userid', $apiDBAnswer["userid"]);

if ($db->update ("things_todo", $updatedData)) {
    echo "SUCCESS";
}
else {
    echo "ERROR: INTERNAL API ERROR";
}
//END



//UPDATE API REQUEST TIME
$updatedData2 = Array ('lastrequest' => $db->now());

$db->where ('userid', $apiDBAnswer["userid"]);

if ($db->update ("things_api", $updatedData2)) {
    //fine
}
else {
    //error
}
//END


} else {
	//Secret not found
	exit("ERROR: SECRET WRONG");
}


?>
