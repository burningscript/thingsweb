<?php
require_once('../class.php');

$session = new sessionManage();
$logged_in = $session->checkIsLoggedIn(true, '' . configAndConnect::URL . 'login/');//If not 

$is_activated = $session->IsAccountActivated();
if ($is_activated) {//Account is activated
    $user_details = new accountDetails();
    $user_details_array = $user_details->accountData();//Array for user account details
}else{
    exit("Not activated");
}

if($user_details_array['uid'] != 5)
{
    exit("No permissions");
}



if (!empty($_POST['username'])) {
    //Hidden form was filled in...
    //Suspected BOT
    //Do anything EXCEPT attempt register
    exit;
}
$rh = new configAndConnect();
if ($rh->issetCheck('THE_username') && $rh->issetCheck('THE_password') && $rh->issetCheck('THE_email')) {
    $register = new doRegisterAttempt($_POST['THE_username'], $_POST['THE_password'], $_POST['THE_email']);
    echo $register->attemptRegister();
} else {
    $rh->outputString("None of Username, Password or Email can be empty");
}